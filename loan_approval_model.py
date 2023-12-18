import joblib
from sklearn.ensemble import RandomForestClassifier

# Sample data
X = [[45000, 600], [65000, 700], [30000, 550]]
y = ['Not Approved', 'Approved', 'Not Approved']

# Train a model
model = RandomForestClassifier()
model.fit(X, y)

# Save the model
joblib.dump(model, 'loan_approval_model.pkl')
