<div
    class="d-flex justify-content-center w-100 flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 mb-3">
        @if (request()->is('dashboard*'))
            <i class="bi bi-gear"></i>
            <span>Tableau de bord</span>
        @elseif (request()->is('settings*'))
            <i class="bi bi-gear"></i>
            <span>Paramètres</span>
        @endif
    </h1>
</div>

@if (request()->is('dashboard*'))
    @can('view-users')
        <a href="{{ route('users.index') }}" title="Gestion des utilisateurs, création, modification, suppression, ..."
            class="btn btn-primary p-3 @if (Str::startsWith(Request::url(), route('users.index'))) btn-dark @endif btn-block mb-3">
            <i class="bi bi-person"></i>
            <span>
                Les utilisateurs
            </span>
        </a>
    @endcan

    @can('view-vehicles')
        <a href="{{ route('vehicles.index') }}" title="Gestion des véhicules, création, modification, suppression, ..."
            class="btn btn-primary p-3 @if (Str::startsWith(Request::url(), route('vehicles.index'))) btn-dark @endif btn-block mb-3">
            <i class="bi bi-truck"></i>
            <span>
                Les véhicules
            </span>
        </a>
    @endcan

    @can('view-exams')
        <a href="{{ route('exams.index') }}" title="Gestion des examens, création, modification, suppression, ..."
            class="btn btn-primary p-3 @if (Str::startsWith(Request::url(), route('exams.index'))) btn-dark @endif btn-block mb-3">
            <i class="bi bi-clipboard-check"></i>
            <span>
                Les examens
            </span>
        </a>
    @endcan

    @can('view-payments')
        <a href="{{ route('payments.index') }}" title="Gestion des paiements, création, modification, suppression, ..."
            class="btn btn-primary p-3
    @if (Str::startsWith(Request::url(), route('payments.index'))) btn-dark @endif btn-block mb-3">
            <i class="bi bi-cash"></i>
            <span>
                Les paiements
            </span>
        </a>
    @endcan

    @can('view-spendings')
        <a href="{{ route('spendings.index') }}" title="Gestion des dépenses, création, modification, suppression, ..."
            class="btn btn-primary p-3
    @if (Str::startsWith(Request::url(), route('spendings.index'))) btn-dark @endif btn-block mb-3">
            <i class="bi bi-cash"></i>
            <span>
                Les dépenses
            </span>
        </a>
    @endcan

    @can('view-sessions')
        <a href="{{ route('sessions.index') }}" title="Gestion des sessions, création, modification, suppression, ..."
            class="btn btn-primary p-3
    @if (Str::startsWith(Request::url(), route('sessions.index'))) btn-dark @endif btn-block mb-3">
            <i class="bi bi-clock"></i>
            <span>
                Les sessions
            </span>
        </a>
    @endcan

    @can('view-statistics')
        <a href="{{ route('statistics.index') }}" title="Gestion des statistiques, création, modification, suppression, ..."
            class="btn btn-primary p-3
    @if (Str::startsWith(Request::url(), route('statistics.index'))) btn-dark @endif btn-block mb-3">
            <i class="bi bi-graph-up"></i>
            <span>
                Les statistiques
            </span>
        </a>
    @endcan
@elseif (request()->is('settings*'))
    <a href="{{ route('permissions.index') }}" title="Gestion des permissions"
        class="btn btn-primary p-3 @if (Str::startsWith(Request::url(), route('permissions.index'))) btn-dark @endif btn-block mb-3">
        <i class="bi bi-shield-lock"></i>
        <span>
            Les permissions
        </span>
    </a>
@endif
