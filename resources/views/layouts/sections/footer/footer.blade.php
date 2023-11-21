<!-- Footer-->
<footer class="content-footer footer bg-footer-theme">

</footer>
<!--/ Footer-->
@php
    $values = DB::table('master_skills')
        ->where('is_active', 1)
        ->where('trash_key', 1)
        ->get();
    $skillNames = $values->pluck('skill_name')->toArray();
@endphp

{{-- This is for skills show dynamically with toggleslide(sidebar) --}}

<script>
    $(document).ready(() => {
        let MenuItems = <?= json_encode($skillNames) ?>;
        $("#skillsList").hide();
        $('.myMenu').click((e) => {
            if ($(e.currentTarget).attr('data-slug') == "filter-questions") {
                $("#skillsList").slideToggle();
                $("#skillsList").css({
                    'margin-left': '50px'
                });
            }
        })
        if (MenuItems.find(el => el.includes(location.pathname.split('/')[location.pathname.split('/').length -
                1])) != undefined) {
            $("#skillsList").show();
            $("#skillsList").css({
                'margin-left': '50px'
            });
        }
    });
</script>
