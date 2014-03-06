$(document).ready(function() {
    $("form[id^='changeBasketQuantity']").submit(function(e) {
        e.preventDefault();

//        var altwert1 = $('#basketquantity').attr('value');

        // Überprüfen der Tasteneingaben
        $('.basketquantity').bind('keydown', function(event){

            // Der Tastencode der gedrückten Taste
            var keyCode = event.which;

            // 48-57: Ziffern auf der normalen Tastatur
            var isStandard = (keyCode > 47 && keyCode < 58);

            // 96-105: Ziffern auf dem Ziffernblock
            var isExtended = (keyCode > 95 && keyCode < 106);

            // 8: Backspace, 46: Forward Delete, 37 Left Arrow, 38: Up Arrow, 39: Right Arrow, 40: Down Arrow
            var validKeyCodes = ',8,37,38,39,40,46,';
            var isOther = ( validKeyCodes.indexOf(',' + keyCode + ',') > -1 );

            if( isStandard || isExtended || isOther ) {
                return true;
            } else {
                return false;
            }
        });

        // Referenz auf die Form speichern
        var $this = $(this);
        // ID ermitteln
        var productid = $this.attr('id');
        var useString;
        var useId;
        var formData;
        var url = $this.attr('action');
//        var formData = $this.serialize();
        // Hinterlegte Ajaxloader-Grafik
        var loader = '<img src="fileadmin/test/ajax-loader.gif" class="ajaxloader" width="20" height="20" />';
        // Typ der zu empfangenen Daten (hier: text)
        var typeOfDataToReceive = 'text';

        // action und id aufsplitten
        useString = productid.split("[");
        useId = useString[1].split("]");

        // Prüfung, ob Mengenänderung-Eingabe im Warenkorb ein Integerwert ist
        // Falls nicht, wird vom dem Float der Nachkommawert abgeschnitten
        var changeQuantity = $("#changeBasketQuantity" + "\\[" + useId[0] + "\\] .basketquantity").val();
        if (parseInt(changeQuantity) != changeQuantity) {
            $("#changeBasketQuantity" + "\\[" + useId[0] + "\\] .basketquantity").val(parseInt(changeQuantity));
        }

        // Formulardaten serialisieren
        formData = $this.serialize();

         // Änderungsnachrichtenfeld ausblenden
        $(".changemessage").hide();

        // ajaxloader anzeigen, wenn aktualisieren-button geklickt wurde
        $("#changeBasketQuantity" + "\\[" + useId[0] + "\\] ").append(loader);

        var success = function () {
            // wurde Aktualisierung durchgeführt, dann ajaxloader ausblenden und Nachricht über Änderung einblenden
            $('.ajaxloader').hide();
            $("#changeBasketQuantity" + "\\[" + useId[0] + "\\] .changemessage").fadeIn(500).fadeOut(4000);
        };
        $.post(url, formData, success, typeOfDataToReceive);
    })
});

