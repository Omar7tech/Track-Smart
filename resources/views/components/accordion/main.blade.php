@props(['title' => 'title' , "id" =>"id"])
<div class="accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#{{ $id }}" aria-expanded="false"
                aria-controls="{{ $id }}">
                {{ $title }}
            </button>
        </h2>
        <div id="{{ $id }}" class="accordion-collapse collapse">
            <div class="accordion-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
