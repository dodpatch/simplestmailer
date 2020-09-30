<form class="form-inline ml-3" method="POST", action="{{route('mail.search')}}" id="form-search">
      @csrf
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" name="search" id="search" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search" id="fa-seach"></i>
          </button>
        </div>
      </div>
      <input type="hidden" value="" name="type" id="input-type">
 </form>
