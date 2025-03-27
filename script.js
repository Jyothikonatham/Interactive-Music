document.getElementById('instrumentForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const instrument = document.getElementById('instrumentChoice').value;
    const instrumentInfo = document.getElementById('instrumentInfo');
    const instrumentDetailsSection = document.getElementById('instrumentDetails');
    
    // Hide the instrument selection form
    document.querySelector('.instrument-selection').style.display = 'none';

    // Show the instrument details section
    instrumentDetailsSection.style.display = 'block';

    // Set the content based on the selected instrument
    switch(instrument) {
        case 'guitar':
            instrumentInfo.innerHTML = `
                <div class="instrument-item">
                    <img src="images/guitar.jpg" alt="Guitar" class="instrument-image">
                    <h3>Guitar</h3>
                    <p><strong>Type:</strong> String Instrument</p>
                    <p><strong>Cost:</strong> $200 - $2000</p>
                    <p><strong>Duration:</strong> 6 months - 1 year</p>
                    <p>Learn how to play the guitar with beginner to advanced lessons. Perfect for playing various genres like rock, classical, and pop music.</p>
                </div>
            `;
            break;
        case 'piano':
            instrumentInfo.innerHTML = `
                <div class="instrument-item">
                    <img src="images/piano.jpg" alt="Piano" class="instrument-image">
                    <h3>Piano</h3>
                    <p><strong>Type:</strong> Keyboard Instrument</p>
                    <p><strong>Cost:</strong> $300 - $5000</p>
                    <p><strong>Duration:</strong> 1 year - 3 years</p>
                    <p>Master the piano with structured lessons, starting from basic scales to complex compositions.</p>
                </div>
            `;
            break;
        case 'drums':
            instrumentInfo.innerHTML = `
                <div class="instrument-item">
                    <img src="images/drums.jpg" alt="Drums" class="instrument-image">
                    <h3>Drums</h3>
                    <p><strong>Type:</strong> Percussion Instrument</p>
                    <p><strong>Cost:</strong> $150 - $3000</p>
                    <p><strong>Duration:</strong> 6 months - 2 years</p>
                    <p>Learn to play drums and rhythm techniques with our engaging courses for all skill levels.</p>
                </div>
            `;
            break;
        case 'violin':
            instrumentInfo.innerHTML = `
                <div class="instrument-item">
                    <img src="images/violin.jpg" alt="Violin" class="instrument-image">
                    <h3>Violin</h3>
                    <p><strong>Type:</strong> String Instrument</p>
                    <p><strong>Cost:</strong> $100 - $3000</p>
                    <p><strong>Duration:</strong> 1 year - 3 years</p>
                    <p>From beginner to advanced, our violin courses cover everything from basic techniques to advanced concert pieces.</p>
                </div>
            `;
            break;
        default:
            instrumentInfo.innerHTML = '<p>Please select an instrument to view its details.</p>';
    }
});