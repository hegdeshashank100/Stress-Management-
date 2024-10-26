from flask import Flask, request, jsonify, render_template
import google.generativeai as genai

app = Flask(__name__)

# Configure the Google Generative AI (Replace with your API key)
genai.configure(api_key="")  
mymodel = genai.GenerativeModel("gemini-1.5-flash")  
chat = mymodel.start_chat()

# Serve the HTML file (ai.html)
@app.route('/')
def index():
    return render_template('ai.html')

# Handle chat requests
@app.route('/chat', methods=['POST'])
def chat_endpoint():
    # Get the question from the request
    question = request.json.get('question', '')  
    
    # Get response from AI model
    response = chat.send_message(question + " .answer within 200 characters")  
    
    # Send the response back to the frontend
    return jsonify({'response': response.text})

if __name__ == '__main__':
    # Run the Flask application, accessible from other devices
    app.run(debug=True, host='0.0.0.0', port=5000)
