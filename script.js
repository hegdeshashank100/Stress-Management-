// Redirect to the local server when the "Start Chat" button is clicked
const chatBtn = document.getElementById('chat-btn');

chatBtn.addEventListener('click', () => {
    window.location.href = 'http://127.0.0.1:5000';
});

// Send user input to AI model for Emotional Health Tracker
const userInput = document.getElementById('user-input');
const trackBtn = document.getElementById('track-btn');

trackBtn.addEventListener('click', () => {
    // Send request to AI model to analyze user input
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'emotional_health_tracker.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(`user_input=${encodeURIComponent(userInput.value)}`);

    xhr.onload = () => {
        if (xhr.status === 200) {
            const response = xhr.responseText;
            console.log('AI response:', response);

            // Display AI response for emotional health tracking
            const aiResponse = document.getElementById('ai-response');
            aiResponse.innerHTML = response;
        } else {
            console.error('Error sending user input:', xhr.statusText);
        }
    };
});
// Wait for the document to be ready
document.addEventListener("DOMContentLoaded", function() {
    const sections = document.querySelectorAll('section');

    sections.forEach(section => {
        // Add the pulse class when hovered
        section.addEventListener('mouseenter', function() {
            section.classList.add('pulsing');
            // Remove the pulsing class after 5 seconds
            setTimeout(() => {
                section.classList.remove('pulsing');
            }, 5000); // Stop the pulsing after 5 seconds
        });

        // Optionally remove pulsing on mouse leave
        section.addEventListener('mouseleave', function() {
            section.classList.remove('pulsing');
        });
    });
});