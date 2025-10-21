<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limbus Company Team Generator</title>
    <style>
        body {
            background: #0a0a0a url('/images/wallpaper.png') no-repeat center center fixed;
            background-size: cover;
            font-family: "Segoe UI", "Lucida Bright", sans-serif;
            color: #d4d4d4;
            margin: 0;
            padding: 10px;
            min-height: 100vh;
        }
        .limbus-window {
            background: rgba(26, 26, 26, 0.9);
            border: 1px solid #333;
            margin: 8px auto;
            padding: 0;
            max-width: 880px;
            backdrop-filter: blur(5px);
        }
        .limbus-titlebar {
            background: rgba(42, 42, 42, 0.9);
            color: #d4d4d4;
            padding: 6px 10px;
            font-weight: bold;
            border-bottom: 1px solid #333;
            font-size: 13px;
        }
        .limbus-content {
            padding: 15px;
        }
        .limbus-button {
            background: #333;
            border: 1px solid #555;
            color: #d4d4d4;
            padding: 6px 12px;
            cursor: pointer;
            font-family: inherit;
            font-size: 12px;
        }
        .limbus-button:hover {
            background: #444;
        }
        .identity-card {
            background: rgba(42, 42, 42, 0.9);
            border: 1px solid #444;
            margin: 6px;
            padding: 10px;
            width: 190px;
            float: left;
            font-size: 12px;
            backdrop-filter: blur(3px);
        }
        .damage-slash { background: #8b0000; color: #ff6b6b; padding: 1px 4px; font-size: 13px; margin: 0 1px; }
        .damage-pierce { background: #1e3a5f; color: #6ba8ff; padding: 1px 4px; font-size: 13px; margin: 0 1px; }
        .damage-blunt { background: #2d5a2d; color: #90ee90; padding: 1px 4px; font-size: 13px; margin: 0 1px; }
        .specialty-tag { background: #000000; color: #ffffff; padding: 1px 3px; font-size: 13px; margin: 1px; display: inline-block; }
        .rarity-0 { background: #555; color: #ddd; padding: 1px 6px; font-size: 10px; font-weight: bold; }
        .rarity-00 { background: #2d5a2d; color: #90ee90; padding: 1px 6px; font-size: 10px; font-weight: bold; }
        .rarity-000 { background: #5a2d5a; color: #ee90ee; padding: 1px 6px; font-size: 10px; font-weight: bold; }
        .clear { clear: both; }
        .form-group { margin-bottom: 10px; }
        .form-group label { display: block; margin-bottom: 3px; color: #ccc; font-size: 12px; }
        select, input[type="checkbox"], input[type="radio"] {
            background: #333;
            border: 1px solid #555;
            color: #d4d4d4;
            font-family: inherit;
            font-size: 11px;
        }
        select { padding: 3px; width: 180px; }
    </style>
</head>
<body>
<!-- header -->
<div style="text-align: center; margin-bottom: 10px;">
    <img src="/images/limbus_gen.png" alt="Limbus Company"
         style="max-height: 80px; max-width: 100%;"
         onerror="this.style.display='none'">
</div>

<!-- api -->
<div style="text-align: center; margin-bottom: 20px;">
    <a href="{{ route('identities.manage') }}"
       style="background: #333; color: #d4d4d4; padding: 10px 20px; text-decoration: none; border: 1px solid #555; border-radius: 4px; display: inline-block;">
        I'm from Project Moon!
    </a>
</div>

<form onsubmit="generateTeam(event)">
    @csrf

    <!-- config -->
    <div class="limbus-window">
        <div class="limbus-titlebar">Team Configuration</div>
        <div class="limbus-content">
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                <!-- Team Size -->
                <div class="form-group">
                    <label>Team Size</label>
                    @foreach([5, 6, 7, 12] as $size)
                        <label style="display: block; margin: 3px 0;">
                            <input type="radio" name="team_size" value="{{ $size }}" {{ $size == 5 ? 'checked' : '' }}>
                            {{ $size }} Sinners
                        </label>
                    @endforeach
                </div>

                <!-- Damage Types -->
                <div class="form-group">
                    <label>Damage Types</label>
                    @foreach(['Slash', 'Pierce', 'Blunt'] as $type)
                        <label style="display: block; margin: 3px 0;">
                            <input type="checkbox" name="damage_types[]" value="{{ $type }}" checked>
                            {{ $type }}
                        </label>
                    @endforeach
                </div>

                <!-- Specialties -->
                <div class="form-group">
                    <label>Specialties</label>
                    <select name="specialties[]" multiple size="5">
                        @php
                            $allSpecialties = ['Aggro', 'Ammo', 'Barrier', 'Bind', 'Bleed', 'Burn', 'Charge', 'Discard', 'Fragile', 'Haste', 'Nails', 'Paralyze', 'Poise', 'Rupture', 'Sinking', 'Tremor'];
                        @endphp
                        @foreach($allSpecialties as $specialty)
                            <option value="{{ $specialty }}">{{ $specialty }}</option>
                        @endforeach
                    </select>
                    <div style="font-size: 10px; color: #888; margin-top: 3px;">
                        Hold ctrl to choose multiple; leave empty for any
                    </div>
                </div>
            </div>

            <!-- options and generate btn -->
            <div style="border-top: 1px solid #333; padding-top: 10px; margin-top: 10px;">
                <label style="display: inline-block; margin-right: 15px; font-size: 12px;">
                    <input type="checkbox" name="include_base" value="1">
                    Include base identities?
                </label>

                <button type="submit" class="limbus-button" style="float: right;">
                    Generate random team
                </button>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</form>

<!-- Team Display Area -->
<div class="limbus-window">
    <div class="limbus-titlebar">Team Display</div>
    <div class="limbus-content team-display-area" style="text-align: center; padding: 30px; color: #666; font-size: 12px;">
        meow. meow.
    </div>
</div>

<script>
    function generateTeam(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        // Get form values properly
        const teamSize = document.querySelector('input[name="team_size"]:checked').value;
        const includeBase = document.querySelector('input[name="include_base"]').checked;
        const damageTypes = Array.from(document.querySelectorAll('input[name="damage_types[]"]:checked')).map(cb => cb.value);
        const specialties = Array.from(document.querySelectorAll('select[name="specialties[]"] option:checked')).map(opt => opt.value);

        const data = {
            team_size: parseInt(teamSize),
            include_base: includeBase,
            damage_types: damageTypes,
            specialties: specialties
        };

        console.log('Sending:', data); // Debug log

        fetch('/api/identities/generate-team', {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            body: JSON.stringify(data)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Received:', data); // Debug log
                displayTeam(data.team);
            })
            .catch(error => {
                console.error('Error:', error);
                document.querySelector('.team-display-area').innerHTML = '<div style="color: red;">Error generating team</div>';
            });
    }

    function displayTeam(team) {
        const teamContainer = document.querySelector('.team-display-area');

        if (!team || team.length === 0) {
            teamContainer.innerHTML = '<div style="text-align: center; padding: 30px; color: #666;">No team generated. Try again.</div>';
            return;
        }

        teamContainer.innerHTML = `
            <div class="limbus-titlebar">Generated Team - ${team.length} Sinners</div>
            <div class="limbus-content">
                <div style="display: flex; flex-wrap: wrap; justify-content: center;">
                    ${team.map(identity => `
                        <div class="identity-card">
                            ${identity.image_url ? `
                                <div style="text-align: center; margin-bottom: 8px;">
                                    <img src="${identity.image_url}"
                                         alt="${identity.sinner}"
                                         style="max-width: 120px; max-height: 120px; border: 1px solid #444;"
                                         onerror="this.style.display='none'">
                                </div>
                            ` : ''}
                            <div style="text-align: center;">
                                <div style="font-weight: bold; font-size: 14px; color: #fff; margin-bottom: 3px;">${identity.sinner}</div>
                                <div style="font-size: 11px; color: #ccc; margin-bottom: 6px;">${identity.identity_name}</div>
                                <div style="margin-bottom: 6px;">
                                    <span class="rarity-${identity.rarity}">${identity.rarity}</span>
                                    ${identity.damage_types.map(damageType =>
            `<span class="damage-${damageType.toLowerCase()}">${damageType}</span>`
        ).join('')}
                                </div>
                                <div>
                                    ${identity.specialties.map(specialty =>
            `<span class="specialty-tag">${specialty}</span>`
        ).join('')}
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
                <div class="clear"></div>
            </div>
        `;
    }
</script>
</body>
</html>
