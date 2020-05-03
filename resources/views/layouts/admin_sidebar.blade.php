<nav class="sidebar">
    <div>
        <ul class="sidebar-menu">
            <li onclick="navigateToDashboard()">
                <i class="fas fa-chart-line"></i>
                <div>
                    @if (countUnreadNotificationsForAuthUser() !== 0)
                        <span id="notification-badge" class="badge badge-danger">{{ countUnreadNotificationsForAuthUser() }}</span>
                    @endif
                    <span>@lang('messages.dashboard')</span>
                </div>
            </li>
            <li onclick="navigateToUsers()">
                <i class="fas fa-users"></i>
                <span>@lang('messages.users')</span>
            </li>
            <li onclick="navigateToCategories()">
                <i class="fas fa-clipboard-list"></i>
                <span>@lang('messages.categories')</span>
            </li>
            <li onclick="navigateToSpecifications()">
                <i class="far fa-list-alt"></i>
                <span>{{ trans_choice('messages.specification', 2) }}</span>
            </li>
            <li onclick="navigateToProducts()">
                <i class="fas fa-store-alt"></i>
                <span>@lang('messages.products')</span>
            </li>
        </ul>
    </div>
</nav>
