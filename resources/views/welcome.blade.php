
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MailPilot</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;500;600;700&family=Inria+Serif:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --red: #A32720;
            --teal: #12474B;
            --field: #E2E2E0;
            --white: #FFFFFF;
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--white);
            color: var(--teal);
            font-family: "Domine", serif;
        }

        /* Main desktop canvas */
        .stage {
            position: relative;
            width: 100%;
            max-width: 1440px;
            min-height: 900px;
            margin: 0 auto;
            background: var(--white);
            overflow: hidden;
        }

        /* Title and subtitle */
        .brand {
            position: absolute;
            top: 28px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            z-index: 2;
        }

        .brand h1 {
            width: 201px;
            height: 52px;
            margin: 0;
            color: var(--red);
            font-family: "Inria Serif", serif;
            font-size: 46px;
            font-weight: 700;
            line-height: 52px;
            white-space: nowrap;
        }

        .brand p {
            width: 419px;
            height: 29px;
            margin: 18px 0 0;
            color: var(--red);
            font-family: "Inria Serif", serif;
            font-size: 20px;
            font-weight: 300;
            line-height: 29px;
            white-space: nowrap;
        }

        /* SVG illustration */
        .illustration {
            position: absolute;
            top: 27px;
            right: 63px;
            width: 509px;
            height: 313px;
        }

        .illustration img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Left side: input and settings */
        .left-panel {
            position: absolute;
            top: 187px;
            left: 72px;
            width: 561px;
            margin: 0;
        }

        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .purpose {
            display: block;
            width: 561px;
            height: 229px;
            margin: 0;
            padding: 20px;
            border: 6px solid var(--teal);
            border-radius: 0;
            background: var(--field);
            color: #222222;
            font-family: "Domine", serif;
            font-size: 18px;
            line-height: 1.5;
            text-align: center;
            resize: none;
        }

        .purpose::placeholder {
            color: #777773;
            opacity: 1;
        }

        /* Language, Length and Style */
        .options {
            width: 554px;
            margin-top: 21px;
        }

        .options select {
            display: block;
            width: 100%;
            height: 62px;
            margin: 0 0 21px;
            padding: 0 20px;
            border: 0;
            border-radius: 0;
            background-color: var(--teal);
            color: var(--white);
            font-family: "Domine", serif;
            font-size: 20px;
            font-weight: 400;
            text-align: center;
            text-align-last: center;
            cursor: pointer;
        }

        .options select:last-child {
            margin-bottom: 0;
        }


        .options select option {
            background: #2A7676;
            color: #FFFFFF;
        }

        .options select option:checked {
            background: #2A7676;
            color: #FFFFFF;
        }


        /* Shared button style */
        .action-button {
            display: block;
            width: 185px;
            height: 72px;
            padding: 0 10px;
            border: none;
            border-radius: 9px;
            background: var(--red);
            color: var(--white);
            font-family: "Domine", serif;
            font-size: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .action-button:hover {
            background: #842019;
        }

        .action-button:focus-visible,
        select:focus-visible,
        textarea:focus-visible {
            outline: 3px solid #4A90E2;
            outline-offset: 3px;
        }

        .generate-button {
            margin: 21px auto 0;
        }

        /* Error message */
        .error-message {
            margin: 14px 0 0;
            color: var(--red);
            font-family: "Domine", serif;
            font-size: 14px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        /* Right side: generated email */
        .result {
            position: absolute;
            top: 389px;
            right: 119px;
            width: 568px;
            margin: 0;
        }

        .result textarea {
            display: block;
            width: 568px;
            height: 297px;
            margin: 0;
            padding: 20px;
            border: 6px solid var(--teal);
            border-radius: 0;
            background: var(--field);
            color: #222222;
            font-family: "Domine", serif;
            font-size: 18px;
            font-weight: 400;
            line-height: 1.7;
            resize: none;
            overflow: auto;
        }

        .result textarea::placeholder {
            color: #777773;
            opacity: 1;
        }

        .copy-button {
            margin: 42px auto 0;
        }

        /* Tablet and mobile fallback.
           We will fine-tune this section using your mobile Figma design. */
        @media (max-width: 1100px) {
            .stage {
                min-height: 100vh;
                padding: 30px 24px 50px;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 30px;
                overflow: visible;
            }

            .brand,
            .illustration,
            .left-panel,
            .result {
                position: static;
                transform: none;
            }

            .brand {
                order: 1;
                width: 100%;
            }

            .brand h1 {
                max-width: 100%;
            }

            .brand p {
                max-width: 100%;
                white-space: normal;
            }

            .illustration {
                order: 2;
                width: min(509px, 100%);
                height: auto;
                aspect-ratio: 509 / 313;
            }

            .left-panel {
                order: 3;
                width: min(561px, 100%);
            }

            .purpose {
                width: 100%;
                max-width: 561px;
            }

            .options {
                width: 100%;
            }

            .result {
                order: 4;
                width: min(568px, 100%);
            }

            .result textarea {
                width: 100%;
            }

            .generate-button,
            .copy-button {
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (max-width: 480px) {
            .stage {
                padding: 24px 16px 36px;
                gap: 24px;
            }

            .brand h1 {
                font-size: 40px;
            }

            .brand p {
                width: 100%;
                height: auto;
                font-size: 18px;
                line-height: 1.5;
            }

            .purpose {
                height: 200px;
                padding: 14px;
                font-size: 16px;
            }

            .options select {
                height: 56px;
                font-size: 17px;
            }

            .result textarea {
                height: 297px;
                padding: 14px;
                font-size: 15px;
            }

            .action-button {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <main class="stage">

        <!-- Brand -->
        <header class="brand">
            <h1>MailPilot</h1>
            <p>Your thoughts, professionally written.</p>
        </header>

        <!-- Illustration exported from Figma -->
        <div class="illustration">
            <img
                src="{{ asset('images/mailpilot-illustration.svg') }}"
                alt="MailPilot boat illustration"
            >
        </div>

        <!-- Email request form -->
        <form
            class="left-panel"
            action="/generate"
            method="POST"
        >
            @csrf

            <label class="visually-hidden" for="purpose">
                Email purpose
            </label>

            <textarea
                class="purpose"
                id="purpose"
                name="purpose"
                required
                maxlength="2000"
                dir="auto"
                placeholder="What do you want to say?"
            >{{ session('formData.purpose', '') }}</textarea>

            <div class="options">

                <label class="visually-hidden" for="language">
                    Language
                </label>

                <select
                    id="language"
                    name="language"
                    required
                >
                    

                    <option
                        value="English"
                        @selected(session('formData.language', '') === 'English')
                    >English</option>

                    <option
                        value="Arabic"
                        @selected(session('formData.language', '') === 'Arabic')
                    >Arabic</option>
                </select>

                <label class="visually-hidden" for="length">
                    Email length
                </label>

                <select
                    id="length"
                    name="length"
                    required
                >
                    

                    <option
                        value="short"
                        @selected(session('formData.length', '') === 'short')
                    >Short</option>

                    <option
                        value="medium"
                        @selected(session('formData.length', '') === 'medium')
                    >Medium</option>

                    <option
                        value="long"
                        @selected(session('formData.length', '') === 'long')
                    >Long</option>
                </select>

                <label class="visually-hidden" for="tone">
                    Writing style
                </label>

                <select
                    id="tone"
                    name="tone"
                    required
                >
                   

                    <option
                        value="Formal"
                        @selected(session('formData.tone', '') === 'Formal')
                    >Formal</option>

                    <option
                        value="Friendly"
                        @selected(session('formData.tone', '') === 'Friendly')
                    >Friendly</option>

                    <option
                        value="Professional"
                        @selected(session('formData.tone', '') === 'Professional')
                    >Professional</option>
                </select>

            </div>

            <button
                class="action-button generate-button"
                type="submit"
            >
                Generation
            </button>

            @if(session('error'))
                <p class="error-message" role="alert">
                    {{ session('error') }}
                </p>
            @endif
        </form>

        <!-- Editable generated email -->
        <section class="result" aria-label="Generated email">

            <label class="visually-hidden" for="generatedEmail">
                Generated email. You can edit this text.
            </label>

            <textarea
                id="generatedEmail"
                dir="auto"
                placeholder="Your generated email will appear here"
            >{{ session('generatedEmail', '') }}</textarea>

            <button
                class="action-button copy-button"
                type="button"
                onclick="copyEmail()"
            >
                Copy
            </button>

        </section>

    </main>

    <script>
        async function copyEmail() {
            const email = document.getElementById('generatedEmail').value;

            if (!email.trim()) {
                alert('Please generate an email first.');
                return;
            }

            try {
                await navigator.clipboard.writeText(email);
                alert('Email copied successfully!');
            } catch (error) {
                alert('Could not copy the email.');
            }
        }
    </script>

</body>
</html>
