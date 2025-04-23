<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voice-to-Voice Translation | TravelBuddy</title>
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
            --success: #10b981;
            --danger: #ef4444;
            --info: #3b82f6;
            --warning-bg: #fef3c7;
            --warning-text: #92400e;
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
        h1 { color: var(--primary); margin-bottom: 10px; display: flex; align-items: center; gap: 10px; font-size: 24px; }
        .card > p:first-of-type { margin-bottom: 25px; color: var(--text-light); }

        /* Controls Section */
        .controls-section { margin-bottom: 30px; }
        .language-selectors { display: flex; flex-direction: column; gap: 20px; margin-bottom: 25px; }
        .language-selector label { display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-dark); }
        .language-select { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 5px; font-size: 16px; background-color: var(--white); }
        @media (min-width: 640px) { .language-selectors { flex-direction: row; gap: 15px; } }

        .record-button-container { text-align: center; margin-bottom: 20px; }
        .btn {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            color: var(--white); border: none; padding: 12px 25px; border-radius: 50px; cursor: pointer;
            font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center;
            justify-content: center; gap: 10px; font-size: 16px; min-width: 180px;
        }
        .btn i { font-size: 1.1em; }
        .btn:hover:not(:disabled) { opacity: 0.9; transform: scale(1.03); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); }
        .btn:disabled { background: #d1d5db; color: var(--text-light); cursor: not-allowed; transform: none; opacity: 0.7; }
        .btn-danger { background: var(--danger); }
        .btn-danger:hover:not(:disabled) { background: #dc2626; opacity: 1; }
        .btn-secondary { background: #6b7280; }
        .btn-secondary:hover:not(:disabled) { background: #4b5563; opacity: 1; }

        /* Status & Progress */
        .status-progress-area { margin-top: 20px; padding: 15px; background-color: #f9fafb; border-radius: 8px; border: 1px solid #e5e7eb; min-height: 60px; display: flex; flex-direction: column; justify-content: center; }
        .status { font-size: 14px; color: var(--text-light); text-align: center; margin-bottom: 10px; font-weight: 500; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .status-indicator { width: 10px; height: 10px; border-radius: 50%; background: #9ca3af; transition: background-color 0.3s; display: inline-block; }
        .status-indicator.active { background: var(--success); animation: pulse 1.5s infinite; }
        @keyframes pulse { 0% { opacity: 1; transform: scale(1); } 50% { opacity: 0.6; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }
        .progress-container { width: 100%; display: none; }
        .progress-bar { height: 8px; background-color: #e5e7eb; border-radius: 4px; overflow: hidden; width: 100%; }
        .progress { height: 100%; background-color: var(--primary); width: 0%; transition: width 0.3s ease-in-out; border-radius: 4px; }

        /* Text Areas (Hidden) */
        .text-display-area { display: none; } /* Hide the whole area */
        .text-output { width: 100%; min-height: 100px; padding: 10px; border: 1px solid #d1d5db; border-radius: 5px; resize: none; font-size: 14px; background-color: #f9fafb; }

        /* Action Buttons */
        .action-buttons { margin-top: 20px; display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; }

        /* Error & Warning Messages */
        .error-message, .browser-warning { padding: 12px 15px; border-radius: 5px; margin-top: 20px; display: none; font-size: 14px; line-height: 1.4; text-align: center; }
        .error-message { color: var(--danger); background: #fee2e2; border: 1px solid #fca5a5; }
        .browser-warning { color: var(--warning-text); background: var(--warning-bg); border: 1px solid #fcd34d; }
        .error-message strong, .browser-warning strong { font-weight: 600; }
        .error-message i, .browser-warning i { margin-right: 8px; }

        /* Footer Styles */
        footer { background-color: var(--secondary); color: var(--white); padding: 30px 0; text-align: center; margin-top: 40px; }
        .footer-content { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .copyright { margin-top: 15px; font-size: 14px; color: rgba(255, 255, 255, 0.8); }

        /* Hidden API Key Input */
        .api-key-input { display: none; }
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
            <div class="browser-warning" id="browserWarning">
                {/* Content filled by JS */}
            </div>

            <h1>
                <i class="fas fa-headset"></i>
                Voice-to-Voice Translation
            </h1>
            <p>Speak in one language and hear the translation spoken in another.</p>

            <div class="controls-section">
                <div class="language-selectors">
                    <div class="language-selector">
                        <label for="sourceLanguage">Speak In (Source):</label>
                        <select id="sourceLanguage" class="language-select">
                            <option value="en-US">English (US)</option>
                            <option value="en-GB">English (UK)</option>
                            <option value="hi-IN">Hindi</option>
                            <option value="es-ES">Spanish (Spain)</option>
                            <option value="es-MX">Spanish (Mexico)</option>
                            <option value="fr-FR">French</option>
                            <option value="de-DE">German</option>
                            <option value="it-IT">Italian</option>
                            <option value="pt-BR">Portuguese (Brazil)</option>
                            <option value="ru-RU">Russian</option>
                            <option value="ja-JP">Japanese</option>
                            <option value="zh-CN">Chinese (Mandarin, Simplified)</option>
                            <option value="ar-SA">Arabic (Saudi Arabia)</option>
                            <option value="bn-IN">Bengali (India)</option>
                             </select>
                    </div>
                    <div class="language-selector">
                        <label for="targetLanguage">Translate & Speak In (Target):</label>
                        <select id="targetLanguage" class="language-select">
                            <option value="en">English</option>
                            <option value="hi" selected>Hindi</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <option value="ja">Japanese</option>
                            <option value="zh">Chinese</option>
                            <option value="ar">Arabic</option>
                            <option value="bn">Bengali</option>
                            <option value="ta">Tamil</option>
                            <option value="te">Telugu</option>
                            <option value="mr">Marathi</option>
                            <option value="gu">Gujarati</option>
                            <option value="kn">Kannada</option>
                            <option value="ml">Malayalam</option>
                            <option value="pa">Punjabi</option>
                            <option value="ru">Russian</option>
                            <option value="it">Italian</option>
                            <option value="pt">Portuguese</option>
                             </select>
                    </div>
                </div>

                <div class="record-button-container">
                    <button id="recordBtn" class="btn">
                        <i class="fas fa-microphone"></i> Start Recording
                    </button>
                </div>
            </div>

             <div class="status-progress-area">
                 <div class="status" id="statusArea">
                     <span id="statusText">Select languages and click Start Recording</span>
                     <div class="status-indicator" id="statusIndicator"></div>
                 </div>
                 <div class="progress-container" id="progressContainer">
                    <div class="progress-bar">
                        <div class="progress" id="progressBar"></div>
                    </div>
                </div>
            </div>

             <div class="error-message" id="errorMessage"></div>

            <div class="text-display-area" hidden>
                <div class="text-area-container">
                    <label for="transcribedTextOutput">Detected Speech (Source):</label>
                    <textarea id="transcribedTextOutput" class="text-output" readonly></textarea>
                </div>
                <div class="text-area-container">
                    <label for="translatedTextOutput">Translated Text (Target):</label>
                    <textarea id="translatedTextOutput" class="text-output" readonly></textarea>
                </div>
            </div>

            <div class="action-buttons">
                 <button id="copyBtn" class="btn btn-secondary" disabled>
                    <i class="fas fa-copy"></i> Copy Translation
                </button>
                <button id="clearBtn" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>

            <input type="text" id="geminiApiKey" class="api-key-input" value="AIzaSyBk5G9lWQVncYumqRgxDjWAFRxz8fBAXQ0" readonly>

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
        document.addEventListener('DOMContentLoaded', function() {
            // --- DOM Elements ---
            const recordBtn = document.getElementById('recordBtn');
            const sourceLanguageSelect = document.getElementById('sourceLanguage');
            const targetLanguageSelect = document.getElementById('targetLanguage');
            const statusIndicator = document.getElementById('statusIndicator');
            const statusText = document.getElementById('statusText');
            const statusArea = document.getElementById('statusArea');
            const transcribedTextOutput = document.getElementById('transcribedTextOutput'); // Hidden
            const translatedTextOutput = document.getElementById('translatedTextOutput'); // Hidden
            const copyBtn = document.getElementById('copyBtn');
            const clearBtn = document.getElementById('clearBtn');
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('progressBar');
            const errorMessage = document.getElementById('errorMessage');
            const browserWarning = document.getElementById('browserWarning');
            const geminiApiKeyInput = document.getElementById('geminiApiKey');

            // --- State Variables ---
            let recognition;
            let isRecording = false;
            let finalTranscribedText = ''; // Store the final transcript from speech recognition
            let currentTranslatedText = ''; // Store the final translated text

            // --- Web Speech API Instances ---
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            const synth = window.speechSynthesis;
            let currentUtterance = null;

            // --- Initialization ---
            function initialize() {
                checkBrowserSupport(); // Check and display warnings
                updateStatus("Select languages and click Start Recording", false);
                progressContainer.style.display = 'none';

                if (typeof speechSynthesis !== 'undefined') {
                     loadVoices();
                     if (speechSynthesis.onvoiceschanged !== undefined) {
                         speechSynthesis.onvoiceschanged = loadVoices;
                     }
                 }
            }

            function loadVoices() {
                 if (typeof speechSynthesis === 'undefined') return;
                 const voices = synth.getVoices();
                 console.log(`Loaded ${voices.length} speech synthesis voices.`);
             }

            // --- Browser Support Check ---
            function checkBrowserSupport() {
                 let speechSupported = true;
                 let synthesisSupported = true;

                 if (!SpeechRecognition) {
                     showWarning(`<strong>Speech Recognition Not Supported:</strong> Your browser doesn't support this feature. Please use Chrome or Edge.`);
                     recordBtn.disabled = true;
                     sourceLanguageSelect.disabled = true;
                     speechSupported = false;
                 } else if (navigator.userAgent.includes('Firefox') || (navigator.userAgent.includes('Safari') && !navigator.userAgent.includes('Chrome'))) {
                     showWarning(`<strong>Limited Support:</strong> Speech recognition may have limitations in Firefox and Safari.`);
                 }

                 if (typeof speechSynthesis === 'undefined') {
                     showWarning(`<strong>Speech Synthesis Not Supported:</strong> Your browser cannot speak the translation.`);
                     synthesisSupported = false;
                 }

                 // Check for private browsing mode (heuristic)
                 try {
                     localStorage.setItem('test', 'test');
                     localStorage.removeItem('test');
                 } catch (e) {
                     showWarning(`<strong>Private Mode Detected:</strong> Speech features might not work reliably in private/incognito mode.`);
                 }

                 return speechSupported && synthesisSupported;
             }

            // --- Event Listeners ---
            recordBtn.addEventListener('click', toggleRecording);
            copyBtn.addEventListener('click', copyTranslationText);
            clearBtn.addEventListener('click', clearAll);
            // Update recognition language if changed while not recording
            sourceLanguageSelect.addEventListener('change', () => {
                if (recognition && !isRecording) {
                    recognition.lang = sourceLanguageSelect.value;
                    console.log(`Recognition language set to: ${recognition.lang}`);
                }
            });


            // --- Recording Logic (Web Speech API) ---
            function toggleRecording() {
                if (!SpeechRecognition) {
                    showError("Speech Recognition not supported by this browser.");
                    return;
                }
                if (isRecording) {
                    stopRecognition();
                } else {
                    startRecognition();
                }
            }

            function initializeRecognition() {
                if (!SpeechRecognition) return; // Should already be checked, but safe guard

                recognition = new SpeechRecognition();
                recognition.continuous = true; // Keep listening even after pauses
                recognition.interimResults = true; // Get results as they come
                recognition.lang = sourceLanguageSelect.value;

                finalTranscribedText = ''; // Reset transcript for new session
                transcribedTextOutput.value = ''; // Clear hidden textarea

                recognition.onstart = () => {
                    console.log("Speech recognition started.");
                    isRecording = true;
                    recordBtn.innerHTML = '<i class="fas fa-stop"></i> Stop Recording';
                    recordBtn.classList.add('btn-danger');
                    sourceLanguageSelect.disabled = true;
                    targetLanguageSelect.disabled = true;
                    updateStatus("Listening...", true); // Show active indicator
                    hideError();
                };

                recognition.onend = () => {
                    console.log("Speech recognition ended.");
                    isRecording = false;
                    recordBtn.innerHTML = '<i class="fas fa-microphone"></i> Start Recording';
                    recordBtn.classList.remove('btn-danger');
                    sourceLanguageSelect.disabled = false;
                    targetLanguageSelect.disabled = false;
                    updateStatus("Processing speech...", false);

                    // Only process if we have a final transcript
                    if (finalTranscribedText) {
                         // Trigger the translation and speaking chain
                         processTranscription(finalTranscribedText);
                    } else {
                        updateStatus("No speech detected or recognized.", false);
                        progressContainer.style.display = 'none';
                    }
                };

                recognition.onerror = (event) => {
                    console.error('Speech recognition error:', event.error);
                     let errorMsg = event.error;
                     if (event.error === 'network') {
                         errorMsg = "Network error during speech recognition.";
                     } else if (event.error === 'no-speech') {
                         errorMsg = "No speech detected. Please try speaking louder or closer.";
                     } else if (event.error === 'audio-capture') {
                         errorMsg = "Microphone error. Please check microphone connection/permissions.";
                     } else if (event.error === 'not-allowed') {
                         errorMsg = "Microphone access denied. Please grant permission.";
                     } else if (event.error === 'language-not-supported') {
                         errorMsg = `The selected language (${recognition.lang}) is not supported by your browser's speech recognition.`;
                     }
                    showError(`Speech Error: ${errorMsg}`);
                    stopRecognitionCleanup(); // Ensure UI is reset
                };

                recognition.onresult = (event) => {
                    let interimTranscript = '';
                    // Reset final transcript for this specific result event processing
                    let currentFinalTranscript = '';

                    for (let i = event.resultIndex; i < event.results.length; ++i) {
                        if (event.results[i].isFinal) {
                            currentFinalTranscript += event.results[i][0].transcript;
                        } else {
                            interimTranscript += event.results[i][0].transcript;
                        }
                    }

                    // Append final results to the overall final transcript
                    if (currentFinalTranscript) {
                        finalTranscribedText += currentFinalTranscript + ' '; // Add space between final segments
                        transcribedTextOutput.value = finalTranscribedText.trim(); // Update hidden field
                        console.log("Final Segment:", currentFinalTranscript);
                    }

                    // Display interim results dynamically in status (optional)
                    if (interimTranscript) {
                        // console.log("Interim:", interimTranscript);
                        // You could update statusText here, but it might be jumpy
                        // statusText.textContent = "Listening... " + interimTranscript;
                    }
                };
            }

            function startRecognition() {
                if (!isRecording) {
                    initializeRecognition(); // Setup recognition instance with current language
                    try {
                        recognition.start();
                    } catch (error) {
                        console.error('Error starting recognition:', error);
                        showError('Could not start speech recognition. Check permissions and browser support.');
                        stopRecognitionCleanup();
                    }
                }
            }

            function stopRecognition() {
                if (isRecording && recognition) {
                    recognition.stop(); // This will trigger the 'onend' event where processing starts
                }
                 // UI updates happen in onend or onerror
            }

             function stopRecognitionCleanup() {
                 isRecording = false;
                 recordBtn.innerHTML = '<i class="fas fa-microphone"></i> Start Recording';
                 recordBtn.classList.remove('btn-danger');
                 sourceLanguageSelect.disabled = false;
                 targetLanguageSelect.disabled = false;
                 updateStatus("Ready", false);
                 if (recognition) {
                     recognition.onstart = null; // Remove handlers to prevent issues if stopped abruptly
                     recognition.onend = null;
                     recognition.onerror = null;
                     recognition.onresult = null;
                     recognition = null; // Release the object
                 }
             }


            // --- Processing Chain (Triggered after final transcript) ---
            async function processTranscription(transcribedText) {
                 if (!transcribedText) {
                     updateStatus("No text to process.", false);
                     progressContainer.style.display = 'none';
                     return;
                 }
                 console.log("Processing Transcription:", transcribedText);
                 progressContainer.style.display = 'block';
                 progressBar.style.width = '10%'; // Start progress

                 try {
                     // 1. Translate Text (Gemini)
                     updateStatus("Translating text...", false);
                     progressBar.style.width = '50%';
                     // Extract the simple language code (e.g., 'en' from 'en-US') for Gemini if needed
                     const sourceLangSimple = sourceLanguageSelect.value.split('-')[0];
                     const targetLangSimple = targetLanguageSelect.value; // Target uses simple codes already

                     currentTranslatedText = await translateWithGemini(
                         transcribedText,
                         sourceLangSimple,
                         targetLangSimple
                     );
                     translatedTextOutput.value = currentTranslatedText; // Update hidden field
                     progressBar.style.width = '100%';
                     copyBtn.disabled = false;

                     if (!currentTranslatedText) {
                         throw new Error("Translation returned empty result.");
                     }

                     // 2. Speak Translated Text (Web Speech API)
                     updateStatus("Preparing translated speech...", false);
                      setTimeout(() => {
                         progressContainer.style.display = 'none'; // Hide progress bar before speaking
                         speakTranslatedText(currentTranslatedText);
                     }, 500);

                 } catch (error) {
                     console.error('Translation/Speak processing error:', error);
                     showError(`<strong>Processing Failed:</strong> ${error.message}`);
                     updateStatus("Error occurred", false);
                     progressContainer.style.display = 'none';
                 }
             }


            // --- API Call: Text Translation (Gemini) ---
            // (Keep the same translateWithGemini function from previous step)
             async function translateWithGemini(text, sourceLang, targetLang) {
                const apiKey = geminiApiKeyInput.value.trim();
                if (!apiKey) throw new Error('Gemini API key is missing.');

                // Get full language names for a potentially more natural prompt
                // Find selected option text (might need adjustment if values don't match text exactly)
                const sourceLangName = Array.from(sourceLanguageSelect.options).find(opt => opt.value.startsWith(sourceLang))?.text || sourceLang;
                const targetLangName = targetLanguageSelect.options[targetLanguageSelect.selectedIndex].text;

                const prompt = `Translate the following text from ${sourceLangName} (${sourceLang}) to ${targetLangName} (${targetLang}). Provide only the translated text:\n\n${text}`;
                console.log("Gemini Prompt:", prompt);

                const modelName = 'gemini-1.5-flash';
                const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/${modelName}:generateContent?key=${apiKey}`;

                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ contents: [{ parts: [{ text: prompt }] }] })
                });

                if (!response.ok) {
                    let errorMsg = `Gemini API Error (${response.status})`;
                    try {
                        const errorData = await response.json();
                        errorMsg = errorData.error?.message || `HTTP Error ${response.status}: ${JSON.stringify(errorData)}`;
                    } catch (e) { errorMsg = `HTTP Error ${response.status}: ${response.statusText}`; }
                    throw new Error(errorMsg);
                }

                const data = await response.json();
                 if (data.candidates?.[0]?.content?.parts?.[0]?.text) {
                     return data.candidates[0].content.parts[0].text.trim();
                 } else if (data.promptFeedback?.blockReason) {
                     throw new Error(`Translation blocked by Gemini: ${data.promptFeedback.blockReason}`);
                 } else {
                    console.error("Unexpected Gemini response:", data);
                    throw new Error('No valid translation returned from Gemini.');
                }
            }


            // --- API Call: Text-to-Speech (Web Speech API) ---
            // (Keep the same speakTranslatedText function from previous step)
             function speakTranslatedText(text) {
                 if (typeof speechSynthesis === 'undefined' || !synth) {
                     showError("Speech Synthesis not supported or initialized.");
                     updateStatus("Ready (Speech not supported)", false);
                     progressContainer.style.display = 'none';
                     return;
                 }
                 if (synth.speaking) synth.cancel();
                 if (!text) {
                     updateStatus("Ready (Nothing to speak)", false);
                     progressContainer.style.display = 'none';
                     return;
                 }

                 const voices = synth.getVoices();
                 if (voices.length === 0) {
                     showError('Speech voices not loaded. Please wait or refresh.');
                     loadVoices();
                     updateStatus("Error loading voices", false);
                     progressContainer.style.display = 'none';
                     return;
                 }

                 const targetLang = targetLanguageSelect.value; // Simple code 'hi', 'en'
                 const suitableVoices = voices.filter(v => v.lang === targetLang || v.lang.startsWith(targetLang + '-'));
                 const selectedVoice = suitableVoices.find(v => !v.localService) || suitableVoices[0];

                 if (!selectedVoice) {
                     showError(`No voice available for ${targetLanguageSelect.options[targetLanguageSelect.selectedIndex].text}.`);
                     updateStatus("Error finding voice", false);
                     progressContainer.style.display = 'none';
                     return;
                 }

                 currentUtterance = new SpeechSynthesisUtterance(text);
                 currentUtterance.voice = selectedVoice;
                 currentUtterance.lang = selectedVoice.lang;
                 currentUtterance.rate = 1.0;
                 currentUtterance.pitch = 1.0;

                 hideError();
                 updateStatus("Speaking...", false);
                 progressContainer.style.display = 'block'; // Show progress for speech
                 progressBar.style.width = '0%';

                 currentUtterance.onboundary = (event) => {
                     const textLength = currentUtterance.text.length;
                     if (event.name === 'word' && textLength > 0) {
                         const progress = Math.min(((event.charIndex + event.charLength) / textLength) * 100, 100);
                         progressBar.style.width = `${progress}%`;
                     }
                 };
                 currentUtterance.onstart = () => {
                     console.log("Speech started.");
                     updateStatus("Speaking...", false);
                     recordBtn.disabled = true; // Disable recording during speech
                 };
                 currentUtterance.onend = () => {
                     console.log("Speech finished.");
                     progressBar.style.width = '100%';
                     updateStatus("Translation spoken", false);
                     recordBtn.disabled = false; // Re-enable recording
                     setTimeout(() => {
                         if (statusText.textContent === 'Translation spoken') {
                             progressContainer.style.display = 'none';
                             updateStatus("Ready", false);
                         }
                     }, 1500);
                 };
                 currentUtterance.onerror = (event) => {
                     console.error('SpeechSynthesis Error:', event.error);
                     showError('Speech error: ' + event.error);
                     updateStatus("Speech error", false);
                     progressContainer.style.display = 'none';
                     recordBtn.disabled = false;
                 };

                 setTimeout(() => {
                     console.log(`Attempting to speak with voice: ${selectedVoice.name} (${selectedVoice.lang})`);
                     synth.speak(currentUtterance);
                 }, 100);
             }


            // --- UI Helpers ---
            function updateStatus(message, isPulseActive) {
                statusText.textContent = message;
                if (isPulseActive) {
                    statusIndicator.classList.add('active');
                    if (!statusArea.contains(statusIndicator)) { // Add indicator if not present
                         statusArea.appendChild(statusIndicator);
                    }
                } else {
                    statusIndicator.classList.remove('active');
                     if (statusArea.contains(statusIndicator)) { // Remove indicator when not active
                         // statusArea.removeChild(statusIndicator); // Or hide with CSS
                     }
                }
            }

            function showError(message) {
                errorMessage.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                errorMessage.style.display = 'block';
            }
             function showWarning(message) {
                 browserWarning.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;
                 browserWarning.style.display = 'block';
             }

            function hideError() {
                errorMessage.style.display = 'none';
                errorMessage.innerHTML = '';
            }

            function clearOutputs() {
                 transcribedTextOutput.value = '';
                 translatedTextOutput.value = '';
                 finalTranscribedText = '';
                 currentTranslatedText = '';
                 copyBtn.disabled = true;
             }

            function clearAll() {
                hideError();
                clearOutputs();
                if (synth.speaking) synth.cancel();
                stopRecognition(); // Ensure recognition is stopped if running
                stopRecognitionCleanup(); // Reset UI and state
                updateStatus("Cleared. Ready to record", false);
                progressContainer.style.display = 'none';
                progressBar.style.width = '0%';
            }

            function copyTranslationText() {
                if (!currentTranslatedText) return;
                navigator.clipboard.writeText(currentTranslatedText).then(() => {
                    const originalText = copyBtn.innerHTML;
                    copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                    copyBtn.disabled = true;
                    setTimeout(() => {
                        copyBtn.innerHTML = originalText;
                        copyBtn.disabled = !currentTranslatedText;
                    }, 2000);
                }).catch(err => {
                    console.error('Failed to copy: ', err);
                    showError('Failed to copy text.');
                });
            }

            // --- Run Initializer ---
            initialize();

        });
    </script>
</body>
</html>
