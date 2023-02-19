$(document).on('change', '#il_id', function () {
    let ilID = $(this).find('option:selected').data('id');
    let $ilce = $('#ilce_id');


    $.ajax({
        type: 'post',
        url: "{{ route('DistrictByCity') }}",
        dataType: 'json',
        data: {
            'il_id': ilID
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            console.log(res)
            $ilce.find('option').remove().end().append(new Option('Seçiniz...', '')).val('');

            $.each(res, function (index, item) {
                $ilce.append(new Option(item.ilce, item.id));
            });
        }
    });
});