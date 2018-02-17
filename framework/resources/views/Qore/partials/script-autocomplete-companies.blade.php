<script type="text/javascript">
    $.get('http://localhost/esuite/api/companies', function( data ) {
        $('#autocomplete').autocomplete({
            lookup: data,
            onSelect: function (suggestion) {
                $.get('http://localhost/esuite/api/companies/' + suggestion.data, function( record ){
                    console.log(record);
                    $("#field_rfc").val(record.rfc);
                    $("#field_curp").val(record.curp);
                    $("#field_business_name").val(record.business_name);
                    $("#field_address").val(record.address);
                    $("#field_colony").val(record.colony);
                    $("#field_location").val(record.location);
                    $("#field_outdoor").val(record.outdoor);
                    $("#field_interior").val(record.interior);
                    $("#field_town").val(record.town);
                    $("#field_state").val(record.state);
                    $("#field_pcode").val(record.pcode);
                    $("#field_country").val(record.country);
                    $("#field_contact").val(record.contact);
                    $("#field_phone").val(record.phone);
                    $("#field_sector").val(record.sector);
                    $("#field_registered").val(1);
                });
            }
        });
    });
</script>
