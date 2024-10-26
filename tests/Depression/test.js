document.getElementById("depression-test").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    let score = 0;

    // Calculate the score based on selected answers
    for (let i = 1; i <= 10; i++) {
        const question = document.querySelector(`input[name="q${i}"]:checked`);
        if (question) {
            score += parseInt(question.value);
        }
    }

    // Redirect to the results page with the score as a query parameter
    window.location.href = `depression_result.html?score=${score}`;
});
