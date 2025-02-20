<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

<div class="container">
    <h2>User Profile</h2>
    <div id="userDetails"></div>
    
    <h3>Test History</h3>
    <table>
        <thead>
            <tr>
                <th>Skills Selected</th>
                <th>Score</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody id="testHistory"></tbody>
    </table>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch("api/fetch_profile.php")
        .then(response => response.json())
        .then(data => {
            console.log("Fetched Data:", data);  // Debugging log
            if (data.status === "success") {
                document.getElementById("userDetails").innerHTML = `
                    <p><strong>Name:</strong> ${data.user.first_name} ${data.user.last_name}</p>
                    <p><strong>Email:</strong> ${data.user.email}</p>
                    <p><strong>Phone:</strong> ${data.user.phone}</p>
                `;

                let historyHTML = "";
                data.tests.forEach(test => {
                    historyHTML += `  
                        <tr>
                            <td>${test.skills_selected}</td>
                            <td>${test.score}</td>
                            <td>${test.feedback}</td>
                        </tr>
                    `;
                });
                document.getElementById("testHistory").innerHTML = historyHTML;
            } else {
                document.getElementById("userDetails").innerHTML = "<p>Error: " + data.message + "</p>";
            }
        })
        .catch(error => {
            console.error("AJAX Error:", error);
            document.getElementById("userDetails").innerHTML = "<p>Error fetching data.</p>";
        });
});

</script>

</body>
</html>
