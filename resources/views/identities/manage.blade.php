<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identity API</title>
    <style>
        body {
            background: #0a0a0a;
            color: #00ff00;
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 20px;
        }
        .api-endpoint {
            background: #111;
            border: 1px solid #333;
            margin: 10px 0;
            padding: 15px;
        }
        .method-get { border-left: 4px solid #61affe; }
        .method-post { border-left: 4px solid #49cc90; }
        .method-put { border-left: 4px solid #fca130; }
        .method-delete { border-left: 4px solid #f93e3e; }
        .endpoint { color: #61affe; font-weight: bold; }
        .json {
            background: #1a1a1a;
            padding: 15px;
            margin: 10px 0;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            white-space: pre-wrap;
        }
        .action-button {
            background: #000000;
            color: #00ff00;
            border: 1px solid #00ff00;
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
            font-family: 'Courier New', monospace;
            font-size: 12px;
        }
        .action-button:hover {
            background: #00ff00;
            color: #000;
        }
    </style>
</head>
<body>
<h1>identity api</h1>
<p>> Controller: IdentityController</p>
<p>> Table: identities</p>

<!-- GET ALL IDENTITIES -->
<div class="api-endpoint method-get">
    <span class="endpoint">GET /api/identities</span> - Get all records
    <button class="action-button" onclick="fetchIdentities()">TEST</button>
    <div id="result-all" class="json" style="display:none"></div>
</div>

<!-- GET SPECIFIC IDENTITY -->
<div class="api-endpoint method-get">
    <span class="endpoint">GET /api/identities/{id}</span> - Get specific record
    <input type="number" id="identity-id" placeholder="ID" value="1" style="background:#111;color:#00ff00;border:1px solid #333;padding:5px;margin:0 10px;">
    <button class="action-button" onclick="fetchIdentity()">TEST</button>
    <div id="result-single" class="json" style="display:none"></div>
</div>

<!-- CREATE IDENTITY -->
<div class="api-endpoint method-post">
    <span class="endpoint">POST /api/identities</span> - Create record
    <button class="action-button" onclick="showCreateForm()">CREATE</button>
    <div id="create-form" style="display:none; margin-top:10px;">
            <textarea id="create-data" rows="10" style="width:100%;background:#111;color:#00ff00;border:1px solid #333;padding:10px;font-family:monospace;">
{
    "sinner": "Yi Sang",
    "identity_name": "Test Identity",
    "rarity": "00",
    "damage_types": ["Slash"],
    "specialties": ["Poise"],
    "season": "S1",
    "is_base": false
}</textarea>
        <button class="action-button" onclick="createIdentity()">SUBMIT</button>
        <div id="result-create" class="json" style="display:none"></div>
    </div>
</div>

<!-- UPDATE IDENTITY -->
<div class="api-endpoint method-put">
    <span class="endpoint">PUT /api/identities/{id}</span> - Update record
    <input type="number" id="update-id" placeholder="ID" style="background:#111;color:#00ff00;border:1px solid #333;padding:5px;margin:0 10px;">
    <button class="action-button" onclick="showUpdateForm()">UPDATE</button>
    <div id="update-form" style="display:none; margin-top:10px;">
            <textarea id="update-data" rows="6" style="width:100%;background:#111;color:#00ff00;border:1px solid #333;padding:10px;font-family:monospace;">
{
    "identity_name": "Updated Identity",
    "rarity": "000"
}</textarea>
        <button class="action-button" onclick="updateIdentity()">SUBMIT</button>
        <div id="result-update" class="json" style="display:none"></div>
    </div>
</div>

<!-- DELETE IDENTITY -->
<div class="api-endpoint method-delete">
    <span class="endpoint">DELETE /api/identities/{id}</span> - Delete record
    <input type="number" id="delete-id" placeholder="ID" style="background:#111;color:#00ff00;border:1px solid #333;padding:5px;margin:0 10px;">
    <button class="action-button" onclick="deleteIdentity()">DELETE</button>
    <div id="result-delete" class="json" style="display:none"></div>
</div>

<!-- GENERATE TEAM -->
<div class="api-endpoint method-post">
    <span class="endpoint">POST /api/identities/generate-team</span> - Generate random team
    <button class="action-button" onclick="generateTeam()">GENERATE</button>
    <div id="result-team" class="json" style="display:none"></div>
</div>

<script>
    function fetchIdentities() {
        fetch('/api/identities')
            .then(r => r.json())
            .then(data => {
                document.getElementById('result-all').textContent = JSON.stringify(data, null, 2);
                document.getElementById('result-all').style.display = 'block';
            });
    }

    function fetchIdentity() {
        const id = document.getElementById('identity-id').value;
        fetch(`/api/identities/${id}`)
            .then(r => r.json())
            .then(data => {
                document.getElementById('result-single').textContent = JSON.stringify(data, null, 2);
                document.getElementById('result-single').style.display = 'block';
            });
    }

    function showCreateForm() {
        document.getElementById('create-form').style.display = 'block';
    }

    function createIdentity() {
        const data = JSON.parse(document.getElementById('create-data').value);
        fetch('/api/identities', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        })
            .then(r => r.json())
            .then(data => {
                document.getElementById('result-create').textContent = JSON.stringify(data, null, 2);
                document.getElementById('result-create').style.display = 'block';
            });
    }

    function showUpdateForm() {
        document.getElementById('update-form').style.display = 'block';
    }

    function updateIdentity() {
        const id = document.getElementById('update-id').value;
        const data = JSON.parse(document.getElementById('update-data').value);
        fetch(`/api/identities/${id}`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        })
            .then(r => r.json())
            .then(data => {
                document.getElementById('result-update').textContent = JSON.stringify(data, null, 2);
                document.getElementById('result-update').style.display = 'block';
            });
    }

    function deleteIdentity() {
        const id = document.getElementById('delete-id').value;
        fetch(`/api/identities/${id}`, {
            method: 'DELETE'
        })
            .then(() => {
                document.getElementById('result-delete').textContent = '204 No Content - Identity deleted';
                document.getElementById('result-delete').style.display = 'block';
            });
    }

    function generateTeam() {
        fetch('/api/identities/generate-team', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({team_size: 5, include_base: false})
        })
            .then(r => r.json())
            .then(data => {
                document.getElementById('result-team').textContent = JSON.stringify(data, null, 2);
                document.getElementById('result-team').style.display = 'block';
            });
    }
</script>
</body>
</html>
