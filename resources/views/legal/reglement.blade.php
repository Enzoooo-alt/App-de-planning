<!-- Content -->
        <div class="privacy-content">
            <!-- Section 1 -->
            <section class="privacy-section">
                <h3 class="section-title">1. Reglement</h3>
                <p class="section-text">
                    Bienvenue sur <strong>le reglement de Lyon Palme</strong>.Merci de respecter les règles suivantes.
                </p>
            </section>



  <!-- Footer -->
            <div class="privacy-footer">
                <div class="privacy-actions">
                    <a href="{{ route('register') }}" class="btn-back">
                        ← Retour à l'inscription
                    </a>
                </div>
            </div>




<style>
.privacy-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 2rem 1rem;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.privacy-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    max-width: 900px;
    width: 100%;
    padding: 2.5rem;
    margin: 2rem 0;
}

.privacy-header {
    text-align: center;
    margin-bottom: 2.5rem;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 1.5rem;
}

.privacy-logo {
    color: #2c3e50;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.privacy-title {
    color: #3498db;
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
}

.privacy-date {
    color: #7f8c8d;
    font-size: 0.9rem;
}

.privacy-content {
    line-height: 1.6;
}

.privacy-section {
    margin-bottom: 2.5rem;
}

.section-title {
    color: #2c3e50;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #ecf0f1;
}

.section-text {
    color: #34495e;
    margin-bottom: 1rem;
    text-align: justify;
}

.privacy-list {
    list-style-type: none;
    padding-left: 1.5rem;
    margin: 1rem 0;
}

.privacy-list li {
    margin-bottom: 0.5rem;
    position: relative;
    color: #34495e;
}

.privacy-list li:before {
    content: "•";
    color: #3498db;
    font-weight: bold;
    display: inline-block;
    width: 1em;
    margin-left: -1em;
}

.contact-info {
    background: #f8f9fa;
    border-left: 4px solid #3498db;
    padding: 1.5rem;
    border-radius: 8px;
    margin-top: 1rem;
}

.contact-info p {
    margin-bottom: 0.5rem;
    color: #2c3e50;
}

.privacy-footer {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid #f0f0f0;
    text-align: center;
}

.thank-you {
    font-size: 1.1rem;
    color: #2c3e50;
    font-style: italic;
    margin-bottom: 1.5rem;
}

.privacy-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-back {
    background: #3498db;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

.btn-dashboard {
    background: #2ecc71;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-dashboard:hover {
    background: #27ae60;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
}



/* Responsive */
@media (max-width: 768px) {
    .privacy-card {
        padding: 1.5rem;
    }
    
    .privacy-logo {
        font-size: 2rem;
    }
    
    .privacy-title {
        font-size: 1.5rem;
    }
    
    .privacy-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-back, .btn-dashboard {
        width: 100%;
        max-width: 250px;
        text-align: center;
    }
}
</style>
