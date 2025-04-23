<?php
// travelp.php - Travel Phrasebook

// List of supported languages and their codes
$languages = [
    'English' => 'en',
    'Hindi' => 'hi',
    'Spanish' => 'es',
    'French' => 'fr',
    'German' => 'de',
    'Italian' => 'it',
    'Portuguese' => 'pt',
    'Russian' => 'ru',
    'Japanese' => 'ja',
    'Chinese' => 'zh',
    'Arabic' => 'ar',
    'Bengali' => 'bn',
    'Turkish' => 'tr',
    'Korean' => 'ko',
    'Thai' => 'th',
    'Vietnamese' => 'vi',
    'Dutch' => 'nl',
    'Greek' => 'el',
    'Hebrew' => 'he',
    'Swahili' => 'sw'
    // Add more languages as needed
];

// Phrase data structure: Category -> English Phrase -> [lang_code => Translation]
// (Using the expanded example structure from before)
$phrases = [
    'Greetings' => [
        'Hello' => [
            'en' => 'Hello',
            'hi' => 'नमस्ते (Namaste)',
            'es' => 'Hola',
            'fr' => 'Bonjour',
            'de' => 'Hallo',
            'ja' => 'こんにちは (Konnichiwa)',
            // ... add other languages
        ],
        'Good morning' => [
            'en' => 'Good morning',
            'hi' => 'सुप्रभात (Suprabhaat)',
            'es' => 'Buenos días',
            'fr' => 'Bonjour', // (Same as Hello in the morning)
            'de' => 'Guten Morgen',
            'ja' => 'おはようございます (Ohayō gozaimasu)',
            // ... add other languages
        ],
        'Good afternoon' => [
            'en' => 'Good afternoon',
            'hi' => 'नमस्कार (Namaskar)', // (Can be used anytime)
            'es' => 'Buenas tardes',
            'fr' => 'Bon après-midi',
            'de' => 'Guten Tag',
            'ja' => 'こんにちは (Konnichiwa)', // (Same as Hello)
            // ... add other languages
        ],
        'Good evening' => [
            'en' => 'Good evening',
            'hi' => 'शुभ संध्या (Shubh sandhya)',
            'es' => 'Buenas noches', // (Also means Good night)
            'fr' => 'Bonsoir',
            'de' => 'Guten Abend',
            'ja' => 'こんばんは (Konbanwa)',
            // ... add other languages
        ],
        'Goodbye' => [
            'en' => 'Goodbye',
            'hi' => 'अलविदा (Alvida)',
            'es' => 'Adiós',
            'fr' => 'Au revoir',
            'de' => 'Auf Wiedersehen',
            'ja' => 'さようなら (Sayōnara)',
            // ... add other languages
        ],
        'How are you?' => [
            'en' => 'How are you?',
            'hi' => 'आप कैसे हैं? (Aap kaise hain?)', // (Formal)
            'es' => '¿Cómo estás?', // (Informal)
            'fr' => 'Comment ça va ?',
            'de' => 'Wie geht es Ihnen?', // (Formal)
            'ja' => 'お元気ですか (Ogenki desu ka?)',
            // ... add other languages
        ],
        'Nice to meet you' => [
            'en' => 'Nice to meet you',
            'hi' => 'आपसे मिलकर खुशी हुई (Aapse milkar khushi hui)',
            'es' => 'Mucho gusto',
            'fr' => 'Enchanté(e)', // (e for female speaker)
            'de' => 'Schön, Sie kennenzulernen',
            'ja' => 'はじめまして (Hajimemashite)', // (Used at first meeting)
             // ... add other languages
        ],
        // ... Add more greeting phrases here ...
    ],
    'Essentials' => [
        'Thank you' => [
            'en' => 'Thank you',
            'hi' => 'धन्यवाद (Dhanyavaad)',
            'es' => 'Gracias',
            'fr' => 'Merci',
            'de' => 'Danke schön',
            'ja' => 'ありがとうございます (Arigatō gozaimasu)',
            // ... add other languages
        ],
        'You\'re welcome' => [
            'en' => 'You\'re welcome',
            'hi' => 'स्वागत है (Swaagat hai)',
            'es' => 'De nada',
            'fr' => 'De rien / Je vous en prie',
            'de' => 'Bitte schön / Gern geschehen',
            'ja' => 'どういたしまして (Dōいたしまして)',
            // ... add other languages
        ],
        'Please' => [
            'en' => 'Please',
            'hi' => 'कृपया (Kripya)',
            'es' => 'Por favor',
            'fr' => 'S\'il vous plaît',
            'de' => 'Bitte',
            'ja' => 'お願いします (Onegaishimasu) / ください (Kudasai)',
            // ... add other languages
        ],
        'Excuse me / Sorry' => [
            'en' => 'Excuse me / Sorry',
            'hi' => 'माफ़ कीजिए (Maaf kijiye)',
            'es' => 'Perdón / Disculpe',
            'fr' => 'Excusez-moi / Pardon',
            'de' => 'Entschuldigung',
            'ja' => 'すみません (Sumimasen)',
            // ... add other languages
        ],
        'Yes' => [
            'en' => 'Yes',
            'hi' => 'हाँ (Haan)',
            'es' => 'Sí',
            'fr' => 'Oui',
            'de' => 'Ja',
            'ja' => 'はい (Hai)',
            // ... add other languages
        ],
        'No' => [
            'en' => 'No',
            'hi' => 'नहीं (Nahin)',
            'es' => 'No',
            'fr' => 'Non',
            'de' => 'Nein',
            'ja' => 'いいえ (Iie)',
            // ... add other languages
        ],
         'I don\'t understand' => [
            'en' => 'I don\'t understand',
            'hi' => 'मुझे समझ नहीं आया (Mujhe samajh nahin aaya)',
            'es' => 'No entiendo',
            'fr' => 'Je ne comprends pas',
            'de' => 'Ich verstehe nicht',
            'ja' => 'わかりません (Wakarimasen)',
            // ... add other languages
        ],
        'Can you speak English?' => [
            'en' => 'Can you speak English?',
            'hi' => 'क्या आप अंग्रेज़ी बोलते हैं? (Kya aap angrezi bolte hain?)',
            'es' => '¿Habla inglés?',
            'fr' => 'Parlez-vous anglais ?',
            'de' => 'Sprechen Sie Englisch?',
            'ja' => '英語を話せますか (Eigo o hanasemasu ka?)',
            // ... add other languages
        ],
        // ... Add more essential phrases here ...
    ],
    'Directions' => [
        'Where is the restroom?' => [
            'en' => 'Where is the restroom?',
            'hi' => 'शौचालय कहाँ है? (Shauchalay kahan hai?)',
            'es' => '¿Dónde está el baño?',
            'fr' => 'Où sont les toilettes ?',
            'de' => 'Wo ist die Toilette?',
            'ja' => 'トイレはどこですか (Toire wa doko desu ka?)',
             // ... add other languages
        ],
        'How do I get to...?' => [
            'en' => 'How do I get to...?',
             'hi' => 'मैं ... कैसे पहुँच सकता हूँ? (Main ... kaise pahunch sakta hoon?)',
             'es' => '¿Cómo llego a...?',
             'fr' => 'Comment vais-je à...?',
             'de' => 'Wie komme ich nach...?',
             'ja' => '... にはどう行けばいいですか (... ni wa dō ikeba ii desu ka?)',
             // ... add other languages
        ],
        // ... Add more direction phrases here ...
    ],
    'Food & Dining' => [
         'Water' => [
            'en' => 'Water',
             'hi' => 'पानी (Paani)',
             'es' => 'Agua',
             'fr' => 'Eau',
             'de' => 'Wasser',
             'ja' => '水 (Mizu)',
             // ... add other languages
        ],
         'The bill, please' => [
            'en' => 'The bill, please',
             'hi' => 'बिल, कृपया (Bill, kripya)',
             'es' => 'La cuenta, por favor',
             'fr' => 'L\'addition, s\'il vous plaît',
             'de' => 'Die Rechnung, bitte',
             'ja' => 'お会計お願いします (Okaikei onegaishimasu)',
             // ... add other languages
        ],
        // ... Add more food phrases here ...
    ],
    'Shopping' => [
         'How much is this?' => [
            'en' => 'How much is this?',
             'hi' => 'यह कितने का है? (Yeh kitne ka hai?)',
             'es' => '¿Cuánto cuesta esto?',
             'fr' => 'Combien ça coûte ?',
             'de' => 'Wie viel kostet das?',
             'ja' => 'これはいくらですか (Kore wa ikura desu ka?)',
             // ... add other languages
        ],
        // ... Add more shopping phrases here ...
    ],
    'Numbers' => [
         'One' => [
            'en' => 'One', 'hi' => 'एक (Ek)', 'es' => 'Uno', 'fr' => 'Un', 'de' => 'Eins', 'ja' => '一 (Ichi)',
        ],
         'Two' => [
             'en' => 'Two', 'hi' => 'दो (Do)', 'es' => 'Dos', 'fr' => 'Deux', 'de' => 'Zwei', 'ja' => '二 (Ni)',
        ],
         'Three' => [
             'en' => 'Three', 'hi' => 'तीन (Teen)', 'es' => 'Tres', 'fr' => 'Trois', 'de' => 'Drei', 'ja' => '三 (San)',
        ],
        // ... Add more number phrases here ...
    ],
    'Emergencies' => [
         'Help!' => [
            'en' => 'Help!', 'hi' => 'मदद! (Madad!)', 'es' => '¡Ayuda!', 'fr' => 'Au secours !', 'de' => 'Hilfe!', 'ja' => '助けて！ (Tasukete!)',
        ],
         'Call the police' => [
             'en' => 'Call the police', 'hi' => 'पुलिस को बुलाओ (Police ko bulao)', 'es' => 'Llame a la policía', 'fr' => 'Appelez la police', 'de' => 'Rufen Sie die Polizei', 'ja' => '警察を呼んでください (Keisatsu o yonde kudasai)',
        ],
        // ... Add more emergency phrases here ...
    ],
    // ... Add more categories like 'Accommodation', 'Transportation', 'Time & Dates' etc. ...
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Phrasebook | TravelBuddy</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #f97316;
            --primary-light: #fb923c;
            --secondary: #ff5e00;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f7fafc;
            --white: #ffffff;
            --card-bg: #f8f9fa; /* Background for phrase cards */
            --tab-inactive: #e5e7eb;
            --tab-hover: #d1d5db;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        header {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            color: var(--white);
            padding: 15px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky; /* Make header sticky */
            top: 0;
            z-index: 100; /* Ensure header is above content */
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo { font-size: 24px; font-weight: bold; }
        .back-btn { background: none; border: none; color: var(--white); font-size: 16px; cursor: pointer; display: flex; align-items: center; gap: 5px; }

        /* Main Content Styles */
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; flex: 1; }
        .card { background: var(--white); border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 30px; margin-bottom: 30px; }
        h1 { color: var(--primary); margin-bottom: 10px; display: flex; align-items: center; gap: 10px; }
        .card > p:first-of-type { margin-bottom: 25px; color: var(--text-light); }


        /* Language Selector */
        .language-selector { margin-bottom: 25px; }
        .language-selector h3 { margin-bottom: 15px; font-size: 1.1em; color: var(--text-dark); }
        .language-tabs { display: flex; flex-wrap: wrap; gap: 8px; }
        .language-tab {
            padding: 8px 16px; border-radius: 20px; background: var(--tab-inactive);
            cursor: pointer; transition: all 0.3s; font-size: 0.9em;
            border: 1px solid transparent; /* Add border for smooth transition */
        }
        .language-tab:hover { background: var(--tab-hover); }
        .language-tab.active { background: var(--primary); color: white; border-color: var(--primary); }

        /* Search Box */
        .search-box { margin-bottom: 25px; position: relative; }
        .search-input {
            width: 100%; padding: 12px 15px 12px 40px; border: 1px solid #d1d5db;
            border-radius: 25px; /* Pill shape search */ font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .search-input:focus {
            outline: none; border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.3); /* Focus ring */
        }
        .search-icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--text-light); }

        /* Category Tabs */
        .category-section h3 { margin-bottom: 15px; font-size: 1.1em; color: var(--text-dark); }
        .category-tabs { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 25px; }
        .category-tab {
            padding: 8px 16px; border-radius: 5px; background: var(--tab-inactive);
            cursor: pointer; transition: all 0.3s; font-size: 0.9em;
             border: 1px solid transparent;
        }
        .category-tab:hover { background: var(--tab-hover); }
        .category-tab.active { background: var(--primary); color: white; border-color: var(--primary); }

        /* Phrase List */
        .phrase-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); /* Slightly smaller min width */
            gap: 15px; /* Reduced gap */
        }
        .phrase-card {
            background: var(--card-bg); border-radius: 8px; padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex; flex-direction: column; /* Ensure content stacks */
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
         .phrase-card:hover {
             transform: translateY(-3px);
             box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
         }

        .phrase-english { font-weight: 600; margin-bottom: 8px; color: var(--primary); font-size: 1.05em; }
        .phrase-translation { font-size: 1em; color: var(--text-dark); margin-bottom: 8px; word-wrap: break-word; }
        .language-name { font-size: 0.8em; color: var(--text-light); margin-top: auto; /* Push to bottom */ padding-top: 10px; /* Add space above language name */ }
        /* Removed .phrase-actions and .speak-btn styles */

        .no-phrases { color: var(--text-light); text-align: center; padding: 20px; }

        /* Footer Styles */
        footer { background-color: var(--secondary); color: var(--white); padding: 30px 0; text-align: center; margin-top: 30px; }
        .footer-content { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .copyright { margin-top: 15px; font-size: 14px; color: rgba(255, 255, 255, 0.8); }

        @media (max-width: 768px) {
            .phrase-list { grid-template-columns: 1fr; } /* Stack cards on smaller screens */
            h1 { font-size: 1.5em; }
            .language-tab, .category-tab { padding: 6px 12px; font-size: 0.85em; }
        }
         @media (max-width: 480px) {
             .card { padding: 20px; }
             .language-tabs, .category-tabs { gap: 6px; }
             .phrase-list { gap: 10px; }
         }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">travelbuddy</div>
            <button class="back-btn" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> Back
            </button>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <h1>
                <i class="fas fa-book-open"></i>
                Travel Phrasebook
            </h1>
            <p>Essential phrases for travelers. Select a language and category, or search below.</p> {/* Updated description */}

            <div class="language-selector">
                <h3>Select Language:</h3>
                <div class="language-tabs">
                    <?php foreach ($languages as $name => $code): ?>
                        <div class="language-tab" data-lang="<?= htmlspecialchars($code) ?>">
                            <?= htmlspecialchars($name) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search phrases (in English)..." id="phraseSearch">
            </div>

            <div class="category-section">
                 <h3>Select Category:</h3>
                 <div class="category-tabs">
                    <?php foreach (array_keys($phrases) as $category): ?>
                        <div class="category-tab" data-category="<?= htmlspecialchars($category) ?>">
                            <?= htmlspecialchars($category) ?>
                        </div>
                    <?php endforeach; ?>
                 </div>
            </div>


            <div class="phrase-list" id="phraseList">
                <p class="no-phrases">Loading phrases...</p>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="logo" style="font-size: 28px; margin-bottom: 15px;">travel<span style="color: white;">buddy</span></div>
            <p>Your smart travel companion for every journey</p>
            <div class="copyright">
                 &copy; <?php echo date("Y"); ?> TravelBuddy. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // --- Data (from PHP) ---
        const languages = <?= json_encode($languages) ?>;
        const phrases = <?= json_encode($phrases) ?>;

        // --- DOM Elements ---
        const languageTabsContainer = document.querySelector('.language-tabs');
        const categoryTabsContainer = document.querySelector('.category-tabs');
        const phraseList = document.getElementById('phraseList');
        const searchInput = document.getElementById('phraseSearch');

        // --- State ---
        let currentLanguage = 'en'; // Default language code
        let currentCategory = Object.keys(phrases)[0] || 'Greetings'; // Default to first category
        let currentSearch = '';

        // --- Initialization ---
        document.addEventListener('DOMContentLoaded', () => {
            // Set initial active tabs
            setActiveTab(languageTabsContainer, `[data-lang="${currentLanguage}"]`);
            setActiveTab(categoryTabsContainer, `[data-category="${currentCategory}"]`);

            // Load initial phrases
            loadPhrases();

            // Set up event listeners
            setupEventListeners();
        });


        // --- Phrase Loading and Filtering ---
        function loadPhrases() {
            phraseList.innerHTML = ''; // Clear previous phrases

            if (!phrases[currentCategory]) {
                 phraseList.innerHTML = '<p class="no-phrases">No phrases available for this category.</p>';
                 return;
            }

            const searchLower = currentSearch.toLowerCase();

            // Filter phrases based on search term (searches English phrase)
            const filteredPhrases = Object.entries(phrases[currentCategory])
                .filter(([english]) => english.toLowerCase().includes(searchLower));

            if (filteredPhrases.length === 0) {
                phraseList.innerHTML = `<p class="no-phrases">No phrases found matching "${escapeHtml(currentSearch)}" in the "${escapeHtml(currentCategory)}" category.</p>`;
                return;
            }

            // Get the full name of the currently selected language
            const currentLanguageName = Object.keys(languages).find(
                key => languages[key] === currentLanguage
            ) || currentLanguage; // Fallback to code if name not found


            filteredPhrases.forEach(([english, translations]) => {
                const translation = translations[currentLanguage] || 'Translation not available';

                // Create the phrase card element
                const phraseCard = document.createElement('div');
                phraseCard.className = 'phrase-card';

                // Removed speak button and related logic
                phraseCard.innerHTML = `
                    <div class="phrase-english">${escapeHtml(english)}</div>
                    <div class="phrase-translation">${escapeHtml(translation)}</div>
                    <div class="language-name">${escapeHtml(currentLanguageName)}</div>
                 `;
                // Removed speak button event listener attachment

                phraseList.appendChild(phraseCard);
            });
        }

        // --- Event Handling ---
        function setupEventListeners() {
            // Language tabs
            languageTabsContainer.addEventListener('click', (event) => {
                const targetTab = event.target.closest('.language-tab');
                if (targetTab && !targetTab.classList.contains('active')) {
                    currentLanguage = targetTab.dataset.lang;
                    setActiveTab(languageTabsContainer, targetTab);
                    loadPhrases(); // Reload phrases for the new language
                }
            });

            // Category tabs
            categoryTabsContainer.addEventListener('click', (event) => {
                const targetTab = event.target.closest('.category-tab');
                if (targetTab && !targetTab.classList.contains('active')) {
                    currentCategory = targetTab.dataset.category;
                    setActiveTab(categoryTabsContainer, targetTab);
                    loadPhrases(); // Reload phrases for the new category
                }
            });

            // Search input (debounce for performance)
            let searchTimeout;
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    currentSearch = searchInput.value;
                    loadPhrases(); // Reload phrases based on search
                }, 300); // Wait 300ms after typing stops
            });
        }

        // --- Removed Speech Synthesis Function (speakText) ---
        // --- Removed Handle Speak Button Click function ---
        // --- Removed Voice Loading function (loadVoices) ---


        // --- Utility Functions ---
        function setActiveTab(container, selectorOrElement) {
            // Remove active class from all tabs in the container
            container.querySelectorAll('.active').forEach(tab => tab.classList.remove('active'));

            // Add active class to the target tab
            const targetTab = (typeof selectorOrElement === 'string')
                ? container.querySelector(selectorOrElement)
                : selectorOrElement;

            if (targetTab) {
                targetTab.classList.add('active');
            }
        }

        function escapeHtml(unsafe) {
             if (typeof unsafe !== 'string') return unsafe; // Return non-strings as is
             return unsafe
                  .replace(/&/g, "&amp;")
                  .replace(/</g, "&lt;")
                  .replace(/>/g, "&gt;")
                  .replace(/"/g, "&quot;")
                  .replace(/'/g, "&#039;");
         }

    </script>
</body>
</html>
