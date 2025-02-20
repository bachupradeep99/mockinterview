<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prep Ace - Domain Selection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 90%;
            text-align: center;
        }
        h2, h5 {
            font-weight: 800;
            color: #333;
        }
        .animated-button {
            font-weight: 700;
            border: none;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            background: linear-gradient(145deg, #ff9966, #ff5e62);
            color: white;
            border-radius: 12px;
            cursor: pointer;
            transition: all .3s ease;
            text-decoration: none;
            margin: 8px;
            display: inline-block;
        }
        .animated-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }
        .selected-skill {
            background: linear-gradient(145deg, #66ff99, #62ff5e);
            color: black;
        }
        #startTestButton {
            margin-top: 20px;
            font-weight: 700;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.7rem 2rem;
            border-radius: 8px;
            cursor: pointer;
            display: none;
        }
        #startTestButton:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Prep Ace - Domain Selection</h2>
        <h5>Select a Domain</h5>
        <div id="domainList" class="d-flex flex-wrap justify-content-center"></div>
        <h5>Skills Required</h5>
        <div id="skills" class="d-flex flex-wrap justify-content-center"></div>
        <button id="startTestButton" onclick="startTest()">Start Test →</button>
    </div>

    <script>
        const domainData = {
            "Frontend": ["HTML", "CSS", "JavaScript", "React", "Vue"],
            "Backend": ["Node.js", "Java", "Python", "Spring Boot", "Django"],
            "Fullstack": ["MongoDB", "Express.js", "React", "Node.js"],
            "DevOps / Cloud": ["AWS", "Docker", "Kubernetes", "Terraform"],
            "QA / Automation Testing": ["Selenium", "JUnit", "Cypress", "Appium"],
            "Data Science / AI": ["Python", "TensorFlow", "PyTorch", "Scikit-Learn"],
            "Data Analyst": ["SQL", "Power BI", "Tableau", "Excel"],
            "Cybersecurity": ["Penetration Testing", "Network Security", "Ethical Hacking", "Cryptography"],
            "Machine Learning / AI": ["Deep Learning", "NLP", "Computer Vision", "Reinforcement Learning"],
            "Blockchain Development": ["Ethereum", "Smart Contracts", "Solidity", "Hyperledger"],
            "Game Development": ["Unity", "Unreal Engine", "C#", "Game Physics"],
            "Mobile App Development": ["Flutter", "React Native", "Swift", "Kotlin"],
            "Embedded Systems / IoT": ["Arduino", "Raspberry Pi", "Embedded C", "IoT Protocols"],
            "Database Administration": ["MySQL", "PostgreSQL", "MongoDB", "Oracle DB"],
            "Networking / System Administration": ["Linux", "Windows Server", "Networking", "Cloud Security"],
            "Software Testing & QA": ["Unit Testing", "Integration Testing", "Manual Testing", "Performance Testing"]
        };

        const domainList = document.getElementById("domainList");
        const skillsDiv = document.getElementById("skills");
        const startTestButton = document.getElementById("startTestButton");

        Object.keys(domainData).forEach(domain => {
            let button = document.createElement("button");
            button.classList.add("animated-button");
            button.innerText = domain;
            button.onclick = () => selectDomain(domain);
            domainList.appendChild(button);
        });

        function selectDomain(domain) {
            skillsDiv.innerHTML = "";
            domainData[domain].forEach(skill => {
                let skillTag = document.createElement("button");
                skillTag.classList.add("animated-button");
                skillTag.innerText = skill;
                skillTag.onclick = () => {
                    skillTag.classList.toggle("selected-skill");
                    toggleStartButton();
                };
                skillsDiv.appendChild(skillTag);
            });
        }

        function toggleStartButton() {
            const selectedSkills = document.querySelectorAll(".selected-skill");
            startTestButton.style.display = selectedSkills.length ? "inline-block" : "none";
        }

        function startTest() {
            const selectedSkills = Array.from(document.querySelectorAll(".selected-skill"))
                .map(skill => skill.innerText)
                .join(",");

            if (selectedSkills.length > 0) {
                startTestButton.innerText = "Loading...";
                setTimeout(() => {
                    window.location.href = `test.php?skills=${encodeURIComponent(selectedSkills)}`;
                }, 1000);
            }
        }
    </script>
</body>
</html>
