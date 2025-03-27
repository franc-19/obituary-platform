document.getElementById("obituaryForm").addEventListener("submit", function(event) {
    let name = document.getElementById("name").value;
    let dob = document.getElementById("dob").value;
    let dod = document.getElementById("dod").value;
    let content = document.getElementById("content").value;
    let author = document.getElementById("author").value;

    if (!name || !dob || !dod || !content || !author) {
        alert("All fields are required!");
        event.preventDefault();
        return;
    }

    if (new Date(dod) < new Date(dob)) {
        alert("Date of Death cannot be before Date of Birth.");
        event.preventDefault();
    }
});

