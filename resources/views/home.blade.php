@extends('layouts.general')
@php
    Carbon\Carbon::setLocale('fr');
@endphp
@section('content')
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header border-0">
                <h4 class="">Salut <b><?= auth()->user()->name . ' ' . auth()->user()->prenom ?> </b> </h4>
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
    @if (session('InfosRole')->id_role == 16)
        
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header border-0">
                    <h4 class="card-title mb-0">Votre emploi du temps : </h4>
                </div><!-- end cardheader -->
                <div class="card-body pt-0">
                    <div class="upcoming-scheduled">
                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y"
                            data-deafult-date="today" data-inline-date="true">
                    </div>
                    @forelse ($emploiDuTemps as $item)
                        <?php
                        $dayOfWeek = $item->jour_semaine;
                        $currentDate = now();
                        $nextDate = $currentDate->copy()->addDays(($dayOfWeek - $currentDate->dayOfWeek + 7) % 7);
                        $formattedDate = trans('entite.semaine')[$nextDate->dayOfWeek] . ' ' . $nextDate->format('d') . ' ' . trans('entite.mois')[$nextDate->month] . ' ' . $nextDate->format('Y');
                        ?>
                        <h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted">{{ $formattedDate }}</h6>
                        <div class="mini-stats-wid d-flex align-items-center mt-3">
                            <div class="flex-shrink-0 avatar-sm">
                                <span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4">
                                    {{ $loop->iteration }}
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">{{ $item->discipline->libelle_disci }}</h6>
                                <p class="text-muted mb-0">{{ $item->promotion->libelle_pro }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">
                                    {{ substr($item->heure_debut, 0, 5) . ' - ' . substr($item->heure_fin, 0, 5) }}<span
                                        class="text-uppercase"></span></p>
                            </div>
                        </div><!-- end -->
                    @empty
                        <p class="d-flex justify-content-center text-primary">Aucun programme disponible pour le moment.</p>
                    @endforelse


                    <div class="mt-3 text-center">
                        {{-- <a href="javascript:void(0);" class="text-muted text-decoration-underline">Voir tous mes
                            Programmes</a> --}}
                    </div>

                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div>
    @endif
@endsection
