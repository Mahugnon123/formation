@extends("front.app")
@section("content")

<section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb mb-2" data-aos="fade-down">
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="index">Accueil</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted">Nous contacter</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="section bg-gray">
    <div class="container">
        <div class="row justify-content-center align-items-stretch flex-row-reverse contact-row">
            <!-- Formulaire à droite -->
            <div class="col-lg-6 mb-4 mb-lg-0 contact-col contact-col-form" data-aos="fade-left" data-aos-delay="200">
                <div class="contact-form-modern p-4 shadow" id="contactFormBox" data-aos="zoom-in-up" data-aos-delay="400">
                    <h3 class="mb-4 text-primary fw-bold text-end" data-aos="fade-up" data-aos-delay="600">
                        <i class="fa fa-envelope-open-text me-2"></i> Contactez-nous
                    </h3>
                    <form id="contactForm" action="{{ route('contact.store') }}" method="POST" autocomplete="off" data-aos="fade-up" data-aos-delay="800">
                        @csrf
                        <div class="form-group mb-3" data-aos="fade-right" data-aos-delay="900">
                            <label for="name" class="form-label">Votre nom :</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3" data-aos="fade-left" data-aos-delay="950">
                            <label for="mail" class="form-label">Votre Email :</label>
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="Votre Email" required>
                            @error('mail')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3" data-aos="fade-right" data-aos-delay="1000">
                            <label for="subject" class="form-label">Sujet :</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet" required>
                            @error('subject')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3" data-aos="fade-left" data-aos-delay="1050">
                            <label for="message" class="form-label">Votre Message :</label>
                            <textarea name="message" id="message" class="form-control" placeholder="Votre Message" rows="5" required></textarea>
                            @error('message')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid" data-aos="zoom-in" data-aos-delay="1100">
                            <button id="sendBtn" type="submit" class="btn btn-primary btn-lg">
                                <span id="sendBtnText">ENVOYER</span>
                                <span id="sendBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </form>
                    <div id="successMessage" class="alert alert-success mt-4 d-none" data-aos="fade-down" data-aos-delay="1200">
                        Message envoyé avec succès !
                    </div>
                </div>
            </div>
            <!-- Informations à gauche -->
            <div class="col-lg-6 d-flex align-items-center contact-col contact-col-info" data-aos="fade-right" data-aos-delay="200">
                <div class="info-modern w-100 p-4" id="infoBox" data-aos="zoom-in" data-aos-delay="400">
                    <h4 class="mb-3 text-primary fw-bold" data-aos="fade-up" data-aos-delay="600"><i class="fa fa-info-circle me-2"></i> Informations</h4>
                    <ul class="list-unstyled">
                        <li class="info-item mb-4" data-aos="fade-right" data-aos-delay="700">
                            <div class="info-icon"><i class="fa fa-phone-alt"></i></div>
                            <div>
                                <span class="fw-semibold">(+229) 00 00 00 00</span>
                            </div>
                        </li>
                        <li class="info-item mb-4" data-aos="fade-left" data-aos-delay="800">
                            <div class="info-icon"><i class="fa fa-envelope"></i></div>
                            <div>
                                <span class="fw-semibold">contact@edupulse.com</span>
                            </div>
                        </li>
                        <li class="info-item" data-aos="fade-right" data-aos-delay="900">
                            <div class="info-icon"><i class="fa fa-map-marker-alt"></i></div>
                            <div>
                                <span>Adresse, Ville, Pays</span>
                            </div>
                        </li>
                    </ul>
                    <div class="info-desc mt-4" data-aos="fade-up" data-aos-delay="1000">
                        Pour toute question, suggestion ou demande de partenariat, n'hésitez pas à nous contacter via ce formulaire ou par les moyens ci-dessus.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section pt-0">
    </section>
@endsection

<script>
// Plus besoin d'animate.css ici, tout est géré par AOS
</script>

<style>
.info-modern {
    background: linear-gradient(120deg, #e3f0ff 60%, #fff 100%);
    border-radius: 18px;
    box-shadow: 0 2px 12px rgba(24,28,50,0.06);
    min-height: 420px;
}
.info-item {
    display: flex;
    align-items: center;
    gap: 1em;
    font-size: 1.1rem;
    color: #1a1a37;
    transition: background 0.2s, color 0.2s;
    border-radius: 8px;
    padding: 0.5em 0.7em;
}
.info-item:hover {
    background: #0d6efd11;
    color: #0d6efd;
}
.info-icon {
    background: #fff;
    color: #1a1a37;
    border: 2px solid #e3e6ed;
    border-radius: 50%;
    width: 2.2em;
    height: 2.2em;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2em;
    margin-right: 0.5em;
    box-shadow: 0 2px 8px #e3e6ed;
    transition: background 0.2s, color 0.2s, border 0.2s;
}
.info-item:hover .info-icon {
    background: #1a1a37;
    color: #fff;
    border-color: #1a1a37;
}
.info-desc {
    font-size: 1rem;
    color: #5c5c77;
    background: #f8faff;
    border-radius: 8px;
    padding: 1em;
    margin-top: 1em;
}
.contact-form-modern {
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 4px 24px rgba(13,110,253,0.07);
}
.contact-row {
    position: relative;
    margin-top: 2.5rem;
    margin-bottom: 2.5rem;
}
.contact-col-info {
    position: relative;
    z-index: 2;
    transform: translateY(50px);
    transition: transform 0.3s;
}
.contact-col-form {
    position: relative;
    z-index: 3;
    transform: translateY(-30px);
    transition: transform 0.3s;
}
@media (max-width: 991px) {
    .info-modern, .contact-form-modern {
        margin-bottom: 2rem;
        min-height: unset;
    }
    .row.flex-row-reverse {
        flex-direction: column !important;
    }
    .contact-col-info,
    .contact-col-form {
        transform: none !important;
        margin-bottom: 2rem;
    }
}
</style>