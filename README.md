<h2>MindCare-Hub</h2>
<p>MindCare-Hub is a web-based mental wellness platform that blends AI-driven mood detection, music therapy, chatbot support, and counsellor booking into a single, seamless experience. Built using Laravel, Flask, MySQL, and integrated with Spotify API, it offers a comprehensive solution to support emotional wellbeing in one accessible interface.</p>
<br>
<h3>Key Features:</h3>
<ul>
    <li>AI-Powered Mood Detection: Analyzes user-provided text to infer emotional states using a Flask-based ML model.</li>
    <li>Personalized Music Suggestions: Generates mood-based playlists by integrating with the Spotify API.</li>
    <li>Conversational Chatbot: Offers immediate support and guided interaction through AI-driven conversation.</li>
    <li>Counselling Booking System: Allows users to find and book sessions with certified counsellors.</li>
    <li>Secure & Scalable: Built with industry-standard practices in mind—including encryption, structured MVC design, and modular service integratio</li>
</ul>
<br>
<hr>
<p><b> Python 3.11.0| Laravel 12 | PHP 8.2.12 </b></p>
<h3>Setup Instructions:</h3>
<ul>
    <li><b>Install Python Dependencies</b>
        <ol>
            <li>cd flask-backend</li>
            <li>python -m venv venv</li>
            <li>venv/Scripts/activate</li>
            <li>pip install flask joblib requests google-generativeai</li>
        </ol>
    </li>
    <li><b>Install Laravel application dependencies</b>
        <ol>
            <li>cd mindCare-Hub</li>       # Check package.json for further information
            <li>npm install <br>           # Frontend (Node + Vite + Tailwind)
                <ul style="list-style-type:disc;">
                    <li>vite</li>
                    <li>tailwindcss</li>
                    <li>postcss</li>
                    <li>laravel-vite-plugin</li>
                    <li>concurrently</li>
                    <li>axios</li>
                    <li>autoprefixer</li>
                    <li>alpinejs</li>
                    <li>@tailwindcss/forms</li>
                    <li>@tailwindcss/typography</li>                  
                </ul>
            </li>
            <li>composer install</li>   # Laravel (PHP)
            <li>npm run dev</li>        # Verify installation
        </ol>
    </li>
</ul>

<h3>File Structure</h3>
<hr>
MindCare-Hub/
<br>│
<br>├── flask-backend/                              
<br>├── ├── predict_emotion.py                      
<br>├── ├── random_forest_emotion_model.pkl         
<br>├── ├── spotify_utils.py                        
<br>├── ├── tfidf_vectorizer.pkl                    
<br>├── mindCare-Hub/                               
<br>├── ├── app/                                    
<br>├── ├── ├── Http/                               
<br>├── ├── ├── ├── controllers/                    
<br>├── ├── ├── ├── Middleware/
<br>├── ├── ├── ├── Requests
<br>├── ├── ├── ├── Kernal.php
<br>├── ├── ├── Mail/                               
<br>├── ├── ├── Models/                             
<br>├── ├── ├── Providers/                          
<br>├── ├── ├── View/
<br>├── ├── bootstrap/                              
<br>├── ├── config/                                 
<br>├── ├── database/                               
<br>├── ├── public/                                 
<br>├── ├── resources/ 
<br>├── ├── ├── ├── css/                            
<br>├── ├── ├── ├── js/                             
<br>├── ├── ├── ├── views/                          
<br>├── ├── ├── ├── ├── admin/ 
<br>├── ├── ├── ├── ├── auth/ 
<br>├── ├── ├── ├── ├── blogs/ 
<br>├── ├── ├── ├── ├── components/ 
<br>├── ├── ├── ├── ├── counselor/ 
<br>├── ├── ├── ├── ├── emails/ 
<br>├── ├── ├── ├── ├── layouts/ 
<br>├── ├── ├── ├── ├── packages/ 
<br>├── ├── ├── ├── ├── pages/ 
<br>├── ├── ├── ├── ├── payments/ 
<br>├── ├── ├── ├── ├── profile/ 
<br>├── ├── ├── ├── ├── user/ 
<br>├── ├── ├── ├── ├── emotion_predict.blade.php   
<br>├── ├── ├── ├── ├── welcome.blade.php           
<br>├── ├── routes/                                 
<br>├── ├── storage/                                
<br>├── ├── tests/                                  
<br>├── ├── composer.json                           
<br>├── ├── package.json                            
<br>├── ├── postcss.config.js                       
<br>├── ├── tailwind.config.js                      
<br>├── ├── vite.config.js                          
<br>├── ├── webpack.mix.js
<br>├── LICENSE                                     
<br>└── README.md                                   

