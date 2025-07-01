<div class="col-lg-3 col-sm-6 mb-5 formation-card" data-category="{{ $formation->category_id }}">
    <a href="{{ url('/apprenant-course-detail/'.$formation->slug) }}">
        <div class="card p-0 border-primary rounded-0 hover-shadow">
            <div style="height: 200px; overflow: hidden;">
                <img class="card-img-top rounded-0" src="{{ asset($formation->image_url) }}" alt="{{ $formation->titre }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="card-body">
                <ul class="list-inline mb-2">
                    <li class="list-inline-item">
                        <i class="ti-calendar mr-1 text-color"></i>
                        {{ \Carbon\Carbon::parse($formation->created_at)->format('d M Y') }}
                    </li>
                </ul>
                <h4 class="card-title d-flex justify-content-space-between"
                    style="min-height: 2.4em !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important; text-align:center;">
                    {{ $formation->titre }}
                </h4>
                <p class="card-text mb-4"
                   style="min-height: 2.8em !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                    {{ \Illuminate\Support\Str::limit($formation->description, 50) }}
                </p>
                <div class="d-flex justify-content-center mb-3">
                    @if($formation->prix_formation == null)
                        <span class="badge-custom badge-free">
                            <i class="fa fa-unlock me-1"></i> Gratuit
                        </span>
                    @else
                        <span class="badge-custom badge-price">
                            <i class="fa fa-credit-card me-1"></i> {{ $formation->prix_formation + $formation->prix_certification }} fcfa
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </a>
</div>