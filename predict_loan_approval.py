import joblib
import json
import sys

# Load the trained model
model = joblib.load('loan_approval_model.pkl')

# Read input data from PHP as a JSON string
input_data = json.loads(sys.argv[1])

# Make predictions
prediction = model.predict([list(input_data)])[0]

# Return the result to PHP as a JSON string
result = {'prediction': prediction}
print(json.dumps(result))
