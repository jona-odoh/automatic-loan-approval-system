import datetime
import os
import random
import hashlib
from flask import Flask, request, redirect, url_for, session
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
import sqlite3
import joblib
import json
import sys

app = Flask(__name__)

app.config['UPLOAD_FOLDER'] = 'uploads/'
app.secret_key = 'your_secret_key'

#  historical data
historical_data = joblib.load('loan_approval_model.pkl')

# Features and labels for training the machine learning model
X = [[data['income'], data['loan_amount'], data['emi']]
     for data in historical_data]
y = [data['approved'] for data in historical_data]

# Train a basic Random Forest model
model = RandomForestClassifier(random_state=42)
model.fit(X, y)


def is_user_at_least_18(dob):
    today = datetime.date.today()
    dob_date = datetime.datetime.strptime(dob, '%Y-%m-%d').date()
    age = today.year - dob_date.year - \
        ((today.month, today.day) < (dob_date.month, dob_date.day))
    return age >= 18


def eligible(desired_amount, interest, loan_tenure, ex_loan, income, job_status):
    desired_amount = float(request.form['desired_amount'])
    interest = float(request.form['interest'])
    loan_tenure = float(request.form['loan_tenure'])
    r1 = interest / (12 * 100)

    if not all([desired_amount, interest, loan_tenure, ex_loan, income]):
        return {
            'status': 'Not Approved',
            'emi': 0,
            'payment_status': 'Not paid',
            'rejection_reason': 'Your application is incomplete or contains invalid data.',
            'instructions': 'Please provide complete and accurate information.'
        }

    # Additional features for machine learning model
    ml_features = [income, desired_amount, emi1]

    # Make a loan decision using the ensemble method
    ml_prediction = model.predict([ml_features])[0]

    if ml_prediction == 1:
        return {
            'status': 'Approved',
            'emi': emi1,
            'payment_status': 'Not paid',
            'installment_amount': emi1,
        }
    else:
        return {
            'status': 'Not Approved',
            'emi': emi2,
            'payment_status': 'Not paid',
            'installment_amount': emi2,
            'rejection_reason': 'Loan application rejected based on machine learning model.',
            'instructions': 'Please contact customer support for more information.'
        }


def save_to_database(user_id, ref_no, fullname, dob, email, contact_no, national_id, tax_id, employer, job, income, e_duration,
                     expenses, loan_type, loan_tenure, interest, ex_loan, desired_amount, guarantor_name, guarantor_no,
                     guarantor_national_id, purpose, acct_no, bank, bvn, acct_name, up_national_id, bank_statement,
                     guarantor_pic, payment_status, status, job_status, emi):
    # Connect to SQLite database
    conn = sqlite3.connect('loan_application.db')
    cursor = conn.cursor()

    # Insert the loan application data into the database
    cursor.execute("""
        INSERT INTO borrower (
            user_id, ref_no, fullname, dob, email, contact_no, national_id, tax_id, employer, job, income, e_duration,
            expenses, loan_type, loan_tenure, interest, exLoan, desired_amount, guarantor_name, guarantor_no,
            guarantor_national_id, purpose, acct_no, bank, bvn, acct_name, up_national_id, bank_statement, gurantor_pic,
            payment_status, status, job_status, emi
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    """, (
        user_id, ref_no, fullname, dob, email, contact_no, national_id, tax_id, employer, job, income, e_duration,
        expenses, loan_type, loan_tenure, interest, ex_loan, desired_amount, guarantor_name, guarantor_no,
        guarantor_national_id, purpose, acct_no, bank, bvn, acct_name, up_national_id, bank_statement, guarantor_pic,
        payment_status, status, job_status, emi
    ))

    # conn.commit()
    conn.close()


@app.route('/', methods=['GET', 'POST'])
def apply_loan():
    if request.method == 'POST':
        user_id = session['SESS_MEMBER_ID']
        ref_no = str(random.randint(1, 99999999))
        fullname = session['SESS_FIRST_NAME'] + ' ' + session['SESS_LAST_NAME']
        dob = request.form['dob']

        if not is_user_at_least_18(dob):
            session['error'] = "You must be at least 18 years old to apply for a loan."
            return redirect(url_for('index'))

        email = session['SESS_EMAIL']
        contact_no = request.form['contact_no']
        national_id = request.form['national_id']
        tax_id = request.form['tax_id']
        employer = request.form['employer']
        job = request.form['job']
        income = request.form['income']
        e_duration = request.form['e_duration']
        expenses = request.form['expenses']
        loan_type = request.form['loan_type']
        loan_tenure = request.form['loan_tenure']
        interest = request.form['interest']
        ex_loan = request.form['exLoan']
        desired_amount = float(request.form['desired_amount'])
        guarantor_name = request.form['guarantor_name']
        guarantor_no = request.form['guarantor_no']
        guarantor_national_id = request.form['guarantor_national_id']
        purpose = request.form['purpose']
        acct_no = request.form['acct_no']
        bank = request.form['bank']
        bvn = request.form['bvn']
        acct_name = request.form['acct_name']
        job_status = request.form['job_status']

        status = 'Not approved'
        payment_status = 'Not paid'

        # File Uploads
        upload_dir = app.config['UPLOAD_FOLDER']
        up_national_id = ''
        bank_statement = ''
        guarantor_pic = ''

        if 'up_national_id' in request.files:
            file = request.files['up_national_id']
            if file.filename != '':
                prefix = 'national-id' + \
                    hashlib.md5(
                        str(time.time() * random.randint(1, 9999)).encode()).hexdigest()
                up_national_id = os.path.join(
                    upload_dir, prefix + '_' + secure_filename(file.filename))
                file.save(up_national_id)

        if 'bank_statement' in request.files:
            file = request.files['bank_statement']
            if file.filename != '':
                prefix = 'bank-statment' + \
                    hashlib.md5(
                        str(time.time() * random.randint(1, 9999)).encode()).hexdigest()
                bank_statement = os.path.join(
                    upload_dir, prefix + '_' + secure_filename(file.filename))
                file.save(bank_statement)

        if 'gurantor_pic' in request.files:
            file = request.files['gurantor_pic']
            if file.filename != '':
                prefix = 'gurantor-pic' + \
                    hashlib.md5(
                        str(time.time() * random.randint(1, 9999)).encode()).hexdigest()
                guarantor_pic = os.path.join(
                    upload_dir, prefix + '_' + secure_filename(file.filename))
                file.save(guarantor_pic)

        # Check if required files are uploaded
        if not all([up_national_id, bank_statement, guarantor_pic]):
            session['error'] = "Please upload all required documents: National ID, Bank Statement, and Guarantor Picture."
            return redirect(url_for('index'))

        # Check eligibility and job status
        eligibility_data = eligible(
            desired_amount, interest, loan_tenure, ex_loan, income, job_status)

        # Update status and payment_status based on eligibility
        status = eligibility_data['status']
        payment_status = eligibility_data['payment_status']
        installment_amount = eligibility_data['installment_amount']
