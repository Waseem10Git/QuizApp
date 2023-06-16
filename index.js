function getInputValue() {
    const category = document.getElementById("category").value;
    window.localStorage.setItem("category", category);
    const difficulty = document.getElementById("difficulty").value;
    window.localStorage.setItem("difficulty", difficulty);
    const type = document.getElementById("type").value;
    window.localStorage.setItem("type", type);
    const score = document.getElementById("score").value;
    window.localStorage.setItem("score", score);
    let amountOfQuestions = document.getElementById("amountOfQuestions").value;
    if (amountOfQuestions === "any") {
        amountOfQuestions = Math.floor(1 + Math.random() * 50);
    }
    window.localStorage.setItem("amountOfQuestions", amountOfQuestions);
}