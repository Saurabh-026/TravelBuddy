<?php
// voicet.php - Voice to Text using Web Speech API
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voice to Text | TravelBuddy</title>
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
        
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        
        .back-btn {
            background: none;
            border: none;
            color: var(--white);
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        
        /* Main Content Styles */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
            flex: 1;
        }
        
        .card {
            background: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        h1 {
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        /* Voice to Text Controls */
        .voice-controls {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .language-select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .btn {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            color: var(--white);
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        
        .btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
            transform: none;
        }
        
        .btn-danger {
            background: var(--danger);
        }
        
        /* Status Indicators */
        .status {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
            font-size: 14px;
        }
        
        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #d1d5db;
        }
        
        .status-indicator.active {
            background: var(--success);
            animation: pulse 1.5s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        
        /* Text Results */
        .text-results {
            margin-top: 30px;
        }
        
        .text-input {
            width: 100%;
            min-height: 150px;
            padding: 15px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            resize: vertical;
            font-size: 16px;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        /* Browser Support Warning */
        .browser-warning {
            display: none;
            padding: 15px;
            background: #fef3c7;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #92400e;
        }
        footer {
            background-color: #ff5e00;
            color: white;
            padding: 30px 0;
            text-align: center;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .copyright {
            margin-top: 20px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-content">
            <div class="logo">travelbuddy</div>
            <button class="back-btn" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> Back
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="card">
            <div class="browser-warning" id="browserWarning">
                <i class="fas fa-exclamation-triangle"></i> 
                <strong>Note:</strong> Speech recognition works best in Chrome and Edge browsers. 
                Limited support in Firefox and Safari. Not supported in private/incognito mode.
            </div>
            
            <h1>
                <i class="fas fa-microphone"></i>
                Voice to Text
            </h1>
            <p>Convert your speech to text using your browser's built-in speech recognition</p>
            
            <div class="voice-controls">
                <select id="languageSelect" class="language-select">
                    <option value="en-US">English (US)</option>
                    <option value="en-GB">English (UK)</option>
                    <option value="hi-IN">Hindi</option>
                    <option value="es-ES">Spanish</option>
                    <option value="fr-FR">French</option>
                    <option value="de-DE">German</option>
                    <option value="it-IT">Italian</option>
                    <option value="pt-BR">Portuguese</option>
                    <option value="ru-RU">Russian</option>
                    <option value="ja-JP">Japanese</option>
                    <option value="zh-CN">Chinese</option>
                    <option value="ar-SA">Arabic</option>
                    <option value="bn-IN">Bengali</option>
                </select>
                
                <button id="startBtn" class="btn">
                    <i class="fas fa-microphone"></i> Start Recording
                </button>
                
                <div class="status">
                    <div class="status-indicator" id="statusIndicator"></div>
                    <span id="statusText">Ready to record</span>
                </div>
            </div>
            
            <div class="text-results">
                <textarea id="textOutput" class="text-input" placeholder="Your transcribed text will appear here..." readonly></textarea>
                <div class="action-buttons">
                    <button id="copyBtn" class="btn" disabled>
                        <i class="fas fa-copy"></i> Copy Text
                    </button>
                    <button id="clearBtn" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Clear
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="logo" style="font-size: 28px; margin-bottom: 15px;">travel<span style="color: white;">buddy</span></div>
            <p>Your smart travel companion for every journey</p>
            <div class="copyright">
                &copy; 2025 TravelBuddy. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // DOM Elements
        const startBtn = document.getElementById('startBtn');
        const languageSelect = document.getElementById('languageSelect');
        const statusIndicator = document.getElementById('statusIndicator');
        const statusText = document.getElementById('statusText');
        const textOutput = document.getElementById('textOutput');
        const copyBtn = document.getElementById('copyBtn');
        const clearBtn = document.getElementById('clearBtn');
        const browserWarning = document.getElementById('browserWarning');
        
        // Speech recognition variables
        let recognition;
        let isRecording = false;
        
        // Check browser support
        function checkBrowserSupport() {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            
            if (!SpeechRecognition) {
                browserWarning.style.display = 'block';
                browserWarning.innerHTML = `
                    <i class="fas fa-exclamation-triangle"></i> 
                    <strong>Unsupported Browser:</strong> Your browser doesn't support speech recognition. 
                    Please use Chrome, Edge, or Firefox for this feature.
                `;
                startBtn.disabled = true;
                return false;
            }
            
            // Show warning for browsers with limited support
            if (navigator.userAgent.includes('Firefox') || navigator.userAgent.includes('Safari')) {
                browserWarning.style.display = 'block';
            }
            
            return true;
        }
        
        // Initialize speech recognition
        function initializeRecognition() {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            recognition = new SpeechRecognition();
            
            recognition.continuous = true;
            recognition.interimResults = true;
            recognition.lang = languageSelect.value;
            
            recognition.onstart = () => {
                isRecording = true;
                startBtn.innerHTML = '<i class="fas fa-stop"></i> Stop Recording';
                startBtn.classList.add('btn-danger');
                statusIndicator.classList.add('active');
                statusText.textContent = 'Recording...';
            };
            
            recognition.onend = () => {
                if (isRecording) {
                    // Automatically restart if still recording
                    recognition.start();
                }
            };
            
            recognition.onerror = (event) => {
                console.error('Speech recognition error:', event.error);
                showError(`Error: ${event.error}`);
                stopRecording();
            };
            
            recognition.onresult = (event) => {
                let interimTranscript = '';
                let finalTranscript = '';
                
                for (let i = event.resultIndex; i < event.results.length; i++) {
                    const transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        finalTranscript += transcript + ' ';
                    } else {
                        interimTranscript += transcript;
                    }
                }
                
                // Update the textarea with both interim and final results
                textOutput.value = finalTranscript + interimTranscript;
                copyBtn.disabled = false;
            };
        }
        
        // Start recording
        function startRecording() {
            if (!isRecording) {
                initializeRecognition();
                try {
                    recognition.start();
                } catch (error) {
                    console.error('Error starting recognition:', error);
                    showError('Could not start speech recognition. Please ensure microphone permissions are granted.');
                }
            }
        }
        
        // Stop recording
        function stopRecording() {
            if (isRecording && recognition) {
                recognition.stop();
                isRecording = false;
                startBtn.innerHTML = '<i class="fas fa-microphone"></i> Start Recording';
                startBtn.classList.remove('btn-danger');
                statusIndicator.classList.remove('active');
                statusText.textContent = 'Ready to record';
            }
        }
        
        // Toggle recording
        function toggleRecording() {
            if (isRecording) {
                stopRecording();
            } else {
                startRecording();
            }
        }
        
        // Copy text to clipboard
        function copyText() {
            textOutput.select();
            document.execCommand('copy');
            
            // Show feedback
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
            setTimeout(() => {
                copyBtn.innerHTML = originalText;
            }, 2000);
        }
        
        // Clear text
        function clearText() {
            textOutput.value = '';
            copyBtn.disabled = true;
        }
        
        // Error handling
        function showError(message) {
            // Create or show error message element
            let errorElement = document.getElementById('errorMessage');
            if (!errorElement) {
                errorElement = document.createElement('div');
                errorElement.id = 'errorMessage';
                errorElement.className = 'error-message';
                document.querySelector('.card').insertBefore(errorElement, document.querySelector('.text-results'));
            }
            
            errorElement.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
            errorElement.style.display = 'block';
            
            // Hide after 5 seconds
            setTimeout(() => {
                errorElement.style.display = 'none';
            }, 5000);
        }
        
        // Event Listeners
        startBtn.addEventListener('click', toggleRecording);
        copyBtn.addEventListener('click', copyText);
        clearBtn.addEventListener('click', clearText);
        languageSelect.addEventListener('change', () => {
            if (recognition) {
                recognition.lang = languageSelect.value;
            }
        });
        
        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            if (checkBrowserSupport()) {
                initializeRecognition();
            }
            
            // Show warning if in private browsing mode
            try {
                localStorage.setItem('test', 'test');
                localStorage.removeItem('test');
            } catch (e) {
                browserWarning.style.display = 'block';
                browserWarning.innerHTML = `
                    <i class="fas fa-exclamation-triangle"></i> 
                    <strong>Private Browsing Detected:</strong> Speech recognition may not work properly 
                    in private/incognito mode. Please use regular browsing mode for best results.
                `;
            }
        });
    </script>
</body>
</html>