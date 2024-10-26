const chatLogList = document.getElementById('chat-log-list');
const userInput = document.getElementById('user-input');
const sendBtn = document.getElementById('send-btn');

// Function to handle sending the question and displaying the response
sendBtn.addEventListener('click', () => {
    const question = userInput.value.trim();
    if (question !== '') {
        // Append user's question to chat log
        const userChatLogItem = document.createElement('li');
        userChatLogItem.textContent = `You: ${question}`;
        userChatLogItem.classList.add('user');
        chatLogList.appendChild(userChatLogItem);

        // Send question to backend (Python script)
        fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ question })  // Sending the question to Flask
        })
        .then(response => response.json())
        .then(data => {
            const response = data.response;
            const chatLogListItem = document.createElement('li');
            chatLogListItem.textContent = `AI: ${response}`;
            chatLogListItem.classList.add('ai');
            chatLogList.appendChild(chatLogListItem);

            userInput.value = '';  // Clear input after submission
            chatLogList.scrollTop = chatLogList.scrollHeight;  // Auto-scroll to the bottom
        })
        .catch(error => console.error('Error:', error));
    }
});

// Optional: Allow sending message with Enter key
userInput.addEventListener('keypress', (event) => {
    if (event.key === 'Enter') {
        sendBtn.click();
    }
});
