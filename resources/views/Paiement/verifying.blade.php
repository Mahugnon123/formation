@extends("front.app")

@section("content")
<style>
    .verification-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 60vh;
        text-align: center;
    }
    .spinner {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #00458C;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
        margin-bottom: 20px;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<section class="section-sm">
    <div class="container">
        <div class="verification-container">
            <div class="spinner"></div>
            <h2>Finalisation de votre inscription...</h2>
            <p>Veuillez patienter pendant que nous vérifions votre paiement. Vous serez redirigé automatiquement.</p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let provider = "{{ $provider }}";
        let endpoint = '';
        let body = {
            transactionId: "{{ $transaction_id }}",
            formation_id: {{ $formation_id }}
        };
        if (provider === 'kkiapay') {
            endpoint = "{{ route('paiement.kkiapay.callback') }}";
        } else if (provider === 'fedapay') {
            endpoint = "/paiement/fedapay/callback";
        }
        fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(body)
        })
        .then(res => {
            if (!res.ok) {
                throw new Error('La validation du serveur a échoué.');
            }
            return res.json();
        })
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("home") }}';
            } else {
                alert("Erreur lors de la validation : " + data.message);
                window.location.href = '/courses'; 
            }
        })
        .catch(error => {
            console.error("Erreur lors de l'appel de vérification:", error);
            alert("Une erreur technique est survenue. Veuillez réessayer ou contacter le support.");
            window.location.href = '/courses';
        });
    });
</script>
@endpush

{{ config('services.kkiapay.public_key') }}
{{ config('services.fedapay.public_key') }} 