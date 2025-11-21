<div class="navbar-logo">
  @php
    $navbarLogo = \App\Models\SiteSetting::where('key', 'navbar_logo')->value('value') ?? 'assets/LOGO/logo2.png';
  @endphp
  <img src="{{ asset('storage/' . $navbarLogo) }}" alt="Maklos Trader" class="navbar-logo-img" />
</div>

<style>
  .navbar-logo {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 130px;
    overflow: visible;
    position: relative;
    margin-top: -40px;
    margin-bottom: -60px;
  }

  .navbar-logo-img {
    height: 100%;
    width: auto;
    object-fit: contain;
    display: block;
  }

  /* Mobile responsive sizing */
  @media (max-width: 768px) {
    .navbar-logo {
      height: 130px;
      margin-top: -10px;
      margin-bottom: -30px;
      margin-left: -13px;
    }
  }
</style>