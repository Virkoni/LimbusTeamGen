<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Identity API - Management</title>
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
            max-height: 400px;
            overflow-y: auto;
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
        .action-button:disabled {
            background: #333;
            color: #666;
            border-color: #666;
            cursor: not-allowed;
        }
        .error {
            color: #ff4444;
            background: #1a1a1a;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            display: none;
        }
        .success {
            color: #44ff44;
            background: #1a1a1a;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            display: none;
        }
        input, textarea {
            background: #111;
            color: #00ff00;
            border: 1px solid #333;
            padding: 5px;
            font-family: 'Courier New', monospace;
        }
        input:focus, textarea:focus {
            outline: 1px solid #00ff00;
        }
        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }
        .status-success { background: #44ff44; }
        .status-error { background: #ff4444; }
        .status-loading { background: #ffff44; animation: pulse 1s infinite; }
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        .filter-section {
            background: #111;
            border: 1px solid #333;
            margin: 10px 0;
            padding: 15px;
        }
        .filter-row {
            display: flex;
            gap: 10px;
            margin: 5px 0;
            align-items: center;
        }
        .filter-label {
            min-width: 120px;
            color: #61affe;
        }
    </style>
</head>
<body>
<h1>identity api</h1>
<p>> Controller: IdentityController</p>
<p>> Table: identities</p>
<p>> CSRF Token: <span id="csrf-status">Active</span></p>

<!-- STATUS PANEL -->
<div class="filter-section">
    <h3>System Status</h3>
    <div class="filter-row">
        <button class="action-button" onclick="testAllEndpoints()">Test All Endpoints</button>
        <button class="action-button" onclick="clearAllResults()">Clear All Results</button>
        <span id="global-status"></span>
    </div>
</div>

<!-- GET ALL IDENTITIES -->
<div class="api-endpoint method-get">
    <span class="endpoint">GET /api/identities</span> - Get all records
    <span id="status-all" class="status-indicator"></span>
    <button class="action-button" onclick="fetchIdentities()">TEST</button>
    <button class="action-button" onclick="toggleSection('result-all')">Toggle View</button>
    <div id="error-all" class="error"></div>
    <div id="result-all" class="json" style="display:none"></div>
</div>

<!-- GET SPECIFIC IDENTITY -->
<div class="api-endpoint method-get">
    <span class="endpoint">GET /api/identities/{id}</span> - Get specific record
    <span id="status-single" class="status-indicator"></span>
    <input type="number" id="identity-id" placeholder="ID" value="1" min="1">
    <button class="action-button" onclick="fetchIdentity()">TEST</button>
    <div id="error-single" class="error"></div>
    <div id="result-single" class="json" style="display:none"></div>
</div>

<!-- CREATE IDENTITY -->
<div class="api-endpoint method-post">
    <span class="endpoint">POST /api/identities</span> - Create record
    <span id="status-create" class="status-indicator"></span>
    <button class="action-button" onclick="showCreateForm()">CREATE</button>
    <div id="create-form" style="display:none; margin-top:10px;">
        <textarea id="create-data" rows="10" style="width:100%;">
{
    "sinner": "Yi Sang",
    "identity_name": "Test Identity",
    "rarity": "00",
    "damage_types": ["Slash"],
    "specialties": ["Poise"],
    "season": "S1",
    "is_base": false
}</textarea>
        <div class="filter-row">
            <button class="action-button" onclick="createIdentity()">SUBMIT</button>
            <button class="action-button" onclick="hideCreateForm()">CANCEL</button>
            <button class="action-button" onclick="generateRandomIdentity()">GENERATE RANDOM</button>
        </div>
        <div id="error-create" class="error"></div>
        <div id="result-create" class="json" style="display:none"></div>
    </div>
</div>

<!-- UPDATE IDENTITY -->
<div class="api-endpoint method-put">
    <span class="endpoint">PUT /api/identities/{id}</span> - Update record
    <span id="status-update" class="status-indicator"></span>
    <input type="number" id="update-id" placeholder="ID" min="1">
    <button class="action-button" onclick="showUpdateForm()">LOAD & UPDATE</button>
    <div id="update-form" style="display:none; margin-top:10px;">
        <div id="update-loading" style="display:none;">Loading identity data...</div>
        <textarea id="update-data" rows="6" style="width:100%;" placeholder="Loading..."></textarea>
        <div class="filter-row">
            <button class="action-button" onclick="updateIdentity()">SUBMIT UPDATE</button>
            <button class="action-button" onclick="hideUpdateForm()">CANCEL</button>
        </div>
        <div id="error-update" class="error"></div>
        <div id="result-update" class="json" style="display:none"></div>
    </div>
</div>

<!-- DELETE IDENTITY -->
<div class="api-endpoint method-delete">
    <span class="endpoint">DELETE /api/identities/{id}</span> - Delete record
    <span id="status-delete" class="status-indicator"></span>
    <input type="number" id="delete-id" placeholder="ID" min="1">
    <button class="action-button" onclick="deleteIdentity()">DELETE</button>
    <div id="error-delete" class="error"></div>
    <div id="result-delete" class="json" style="display:none"></div>
</div>

<!-- GENERATE TEAM -->
<div class="api-endpoint method-post">
    <span class="endpoint">POST /api/identities/generate-team</span> - Generate random team
    <span id="status-team" class="status-indicator"></span>

    <div class="filter-section">
        <h3>Team Generation Filters</h3>
        <div class="filter-row">
            <span class="filter-label">Team Size:</span>
            <select id="team-size" style="background:#111;color:#00ff00;border:1px solid #333;padding:5px;">
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="12">12</option>
            </select>

            <span class="filter-label">Include Base:</span>
            <input type="checkbox" id="include-base">

            <button class="action-button" onclick="generateTeam()">GENERATE TEAM</button>
        </div>
    </div>

    <div id="error-team" class="error"></div>
    <div id="result-team" class="json" style="display:none"></div>
</div>

<script>
    // Utility functions
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    function setStatus(elementId, status) {
        const element = document.getElementById(elementId);
        element.className = 'status-indicator';
        if (status === 'loading') {
            element.classList.add('status-loading');
        } else if (status === 'success') {
            element.classList.add('status-success');
        } else if (status === 'error') {
            element.classList.add('status-error');
        } else {
            element.className = 'status-indicator';
        }
    }

    function showError(elementId, message) {
        const element = document.getElementById(elementId);
        element.textContent = message;
        element.style.display = 'block';
        setStatus(elementId.replace('error-', 'status-'), 'error');
    }

    function hideError(elementId) {
        document.getElementById(elementId).style.display = 'none';
    }

    function showResult(elementId, data) {
        const element = document.getElementById(elementId);
        element.textContent = typeof data === 'string' ? data : JSON.stringify(data, null, 2);
        element.style.display = 'block';
        setStatus(elementId.replace('result-', 'status-'), 'success');
    }

    function hideResult(elementId) {
        document.getElementById(elementId).style.display = 'none';
    }

    function toggleSection(elementId) {
        const element = document.getElementById(elementId);
        element.style.display = element.style.display === 'none' ? 'block' : 'none';
    }

    function clearAllResults() {
        // Hide all results and errors
        document.querySelectorAll('.json, .error').forEach(el => {
            el.style.display = 'none';
        });
        // Reset all status indicators
        document.querySelectorAll('.status-indicator').forEach(el => {
            el.className = 'status-indicator';
        });
    }

    // GET ALL IDENTITIES
    function fetchIdentities() {
        setStatus('status-all', 'loading');
        hideError('error-all');
        hideResult('result-all');

        fetch('/api/identities')
            .then(r => {
                if (!r.ok) {
                    throw new Error(`HTTP error! status: ${r.status}`);
                }
                return r.json();
            })
            .then(data => {
                showResult('result-all', data);
            })
            .catch(error => {
                showError('error-all', `Error: ${error.message}`);
            });
    }

    // GET SPECIFIC IDENTITY
    function fetchIdentity() {
        const id = document.getElementById('identity-id').value;
        if (!id) {
            showError('error-single', 'Please enter an ID');
            return;
        }

        setStatus('status-single', 'loading');
        hideError('error-single');
        hideResult('result-single');

        fetch(`/api/identities/${id}`)
            .then(r => {
                if (!r.ok) {
                    throw new Error(`HTTP error! status: ${r.status}`);
                }
                return r.json();
            })
            .then(data => {
                showResult('result-single', data);
            })
            .catch(error => {
                showError('error-single', `Error: ${error.message}`);
            });
    }

    // CREATE IDENTITY
    function showCreateForm() {
        document.getElementById('create-form').style.display = 'block';
        hideError('error-create');
        hideResult('result-create');
        setStatus('status-create', '');
    }

    function hideCreateForm() {
        document.getElementById('create-form').style.display = 'none';
    }

    function createIdentity() {
        let data;
        try {
            data = JSON.parse(document.getElementById('create-data').value);
        } catch (e) {
            showError('error-create', 'Invalid JSON format: ' + e.message);
            return;
        }

        setStatus('status-create', 'loading');
        hideError('error-create');
        hideResult('result-create');

        fetch('/api/identities', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: JSON.stringify(data)
        })
            .then(r => {
                if (!r.ok) {
                    return r.json().then(err => { throw new Error(err.message || `HTTP error! status: ${r.status}`); });
                }
                return r.json();
            })
            .then(data => {
                showResult('result-create', data);
                hideCreateForm();
                // Refresh the identities list
                fetchIdentities();
            })
            .catch(error => {
                showError('error-create', `Error: ${error.message}`);
            });
    }

    function generateRandomIdentity() {
        const sinners = ['Yi Sang', 'Faust', 'Don Quixote', 'Ryōshū', 'Meursault', 'Hong Lu', 'Heathcliff', 'Ishmael', 'Rodion', 'Sinclair', 'Outis', 'Gregor'];
        const rarities = ['0', '00', '000'];
        const damageTypes = ['Slash', 'Pierce', 'Blunt'];

        const randomIdentity = {
            sinner: sinners[Math.floor(Math.random() * sinners.length)],
            identity_name: `Random Identity ${Math.floor(Math.random() * 1000)}`,
            rarity: rarities[Math.floor(Math.random() * rarities.length)],
            damage_types: [damageTypes[Math.floor(Math.random() * damageTypes.length)]],
            specialties: [specialties[Math.floor(Math.random() * specialties.length)]],
            season: seasons[Math.floor(Math.random() * seasons.length)],
            is_base: false
        };

        document.getElementById('create-data').value = JSON.stringify(randomIdentity, null, 2);
    }

    // UPDATE IDENTITY
    async function showUpdateForm() {
        const id = document.getElementById('update-id').value;
        if (!id) {
            alert('Please enter an ID to update');
            return;
        }

        document.getElementById('update-form').style.display = 'block';
        document.getElementById('update-loading').style.display = 'block';
        document.getElementById('update-data').value = '';
        hideError('error-update');
        hideResult('result-update');
        setStatus('status-update', 'loading');

        try {
            const response = await fetch(`/api/identities/${id}`);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();

            document.getElementById('update-data').value = JSON.stringify(data, null, 2);
            document.getElementById('update-loading').style.display = 'none';
            setStatus('status-update', 'success');
        } catch (error) {
            document.getElementById('update-loading').style.display = 'none';
            showError('error-update', `Failed to load identity: ${error.message}`);
            setStatus('status-update', 'error');
        }
    }

    function hideUpdateForm() {
        document.getElementById('update-form').style.display = 'none';
    }

    function updateIdentity() {
        const id = document.getElementById('update-id').value;
        if (!id) {
            showError('error-update', 'Please enter an ID');
            return;
        }

        let data;
        try {
            data = JSON.parse(document.getElementById('update-data').value);
        } catch (e) {
            showError('error-update', 'Invalid JSON format: ' + e.message);
            return;
        }

        setStatus('status-update', 'loading');
        hideError('error-update');
        hideResult('result-update');

        fetch(`/api/identities/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: JSON.stringify(data)
        })
            .then(r => {
                if (!r.ok) {
                    return r.json().then(err => { throw new Error(err.message || `HTTP error! status: ${r.status}`); });
                }
                return r.json();
            })
            .then(data => {
                showResult('result-update', data);
                hideUpdateForm();
                // Refresh the identities list
                fetchIdentities();
            })
            .catch(error => {
                showError('error-update', `Error: ${error.message}`);
            });
    }

    // DELETE IDENTITY
    function deleteIdentity() {
        const id = document.getElementById('delete-id').value;
        if (!id) {
            showError('error-delete', 'Please enter an ID');
            return;
        }

        if (!confirm(`Are you sure you want to delete identity #${id}? This action cannot be undone.`)) {
            return;
        }

        setStatus('status-delete', 'loading');
        hideError('error-delete');
        hideResult('result-delete');

        fetch(`/api/identities/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
                'Content-Type': 'application/json'
            }
        })
            .then(r => {
                if (!r.ok) {
                    return r.text().then(text => {
                        throw new Error(`HTTP error! status: ${r.status}, response: ${text}`);
                    });
                }
                if (r.status === 204) {
                    return null;
                }
                return r.json();
            })
            .then(data => {
                showResult('result-delete', '✓ Identity successfully deleted');
                document.getElementById('delete-id').value = '';
                // Refresh the identities list
                fetchIdentities();
            })
            .catch(error => {
                showError('error-delete', `Error: ${error.message}`);
            });
    }

    // GENERATE TEAM
    function generateTeam() {
        const teamSize = document.getElementById('team-size').value;
        const includeBase = document.getElementById('include-base').checked;

        setStatus('status-team', 'loading');
        hideError('error-team');
        hideResult('result-team');

        fetch('/api/identities/generate-team', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: JSON.stringify({
                team_size: parseInt(teamSize),
                include_base: includeBase
            })
        })
            .then(r => {
                if (!r.ok) {
                    return r.json().then(err => {
                        throw new Error(err.message || `HTTP error! status: ${r.status}`);
                    });
                }
                return r.json();
            })
            .then(data => {
                showResult('result-team', data);

                // Display team composition summary
                if (data.team) {
                    const sinnerCount = {};
                    data.team.forEach(identity => {
                        sinnerCount[identity.sinner] = (sinnerCount[identity.sinner] || 0) + 1;
                    });

                    console.log('Team composition:', sinnerCount);
                }
            })
            .catch(error => {
                showError('error-team', `Error: ${error.message}`);
            });
    }

    // TEST ALL ENDPOINTS
    async function testAllEndpoints() {
        const endpoints = [
            { name: 'all', func: fetchIdentities },
            { name: 'team', func: generateTeam }
        ];

        document.getElementById('global-status').textContent = 'Testing endpoints...';

        for (const endpoint of endpoints) {
            await new Promise(resolve => {
                setTimeout(() => {
                    endpoint.func();
                    resolve();
                }, 500);
            });
        }

        document.getElementById('global-status').textContent = 'Testing completed';
        setTimeout(() => {
            document.getElementById('global-status').textContent = '';
        }, 3000);
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Identity API Loaded');
        console.log('CSRF Token:', getCsrfToken());
    });
</script>
</body>
</html>
