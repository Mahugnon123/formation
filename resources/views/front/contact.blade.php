@extends("front.app")
@section("content")

<section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb mb-2">
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="index">Accueil</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted">Nous contacter</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Votre nom :</label>
                        <input type="text" class="form-control mb-3" id="name" name="name" placeholder="Votre nom" required>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mail">Votre Email :</label>
                        <input type="email" class="form-control mb-3" id="mail" name="mail" placeholder="Votre Email" required>
                        @error('mail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Sujet :</label>
                        <input type="text" class="form-control mb-3" id="subject" name="subject" placeholder="Sujet" required>
                        @error('subject')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Votre Message :</label>
                        <textarea name="message" id="message" class="form-control mb-3" placeholder="Votre Message" required></textarea>
                        @error('message')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" value="send" class="btn btn-primary">ENVOYER</button>
                </form>

                {{-- Déplacez ce bloc ici, juste après la fin du formulaire --}}
                @if (session('temporary_message'))
                    <div id="temporaryMessage" style="background-color: #4CAF50; color: white; padding: 15px 20px; border-radius: 5px; margin-top: 15px; opacity: 1; transition: opacity 1s ease-in-out;">
                        {{ session('temporary_message') }}
                    </div>

                    <script>
                        setTimeout(function() {
                            var messageElement = document.getElementById('temporaryMessage');
                            messageElement.classList.add('hidden');
                            setTimeout(function() {
                                if (messageElement && messageElement.parentNode) {
                                    messageElement.parentNode.removeChild(messageElement);
                                }
                            }, 1000); // Durée de la transition (1 seconde)
                        }, 3000); // Durée d'affichage du message (3 secondes)

                        // Ajouter une classe 'hidden' pour l'opacité à 0
                        var style = document.createElement('style');
                        style.innerHTML = `
                            .hidden {
                                opacity: 0;
                            }
                        `;
                        document.head.appendChild(style);
                    </script>
                @endif
                {{-- Fin du bloc déplacé --}}

            </div>
            <div class="col-lg-5">
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit recusandae voluptates doloremque veniam temporibus porro culpa ipsa, nisi soluta minima saepe laboriosam debitis nesciunt. Dolore, labore. Accusamus nulla sed cum aliquid exercitationem debitis error harum porro maxime quo iusto aliquam dicta modi earum fugiat, vel possimus commodi, deleniti et veniam, fuga ipsum praesentium. Odit unde optio nulla ipsum quae obcaecati! Quod esse natus quibusdam asperiores quam vel, tempore itaque architecto ducimus expedita</p>
                <a href="tel:+8802057843248" class="text-color h5 d-block">(+229)</a>
                <a href="mailto:yourmail@email.com" class="mb-5 text-color h5 d-block">contact@sinustic.com</a>
            </div>
        </div>
    </div>
</section>
<section class="section pt-0">
    </section>
@endsection