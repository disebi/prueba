@section('css')
<link rel="stylesheet" type="text/css" href="/plugins/daterangepicker/daterangepicker-bs3.css" />
@append


@section('javascripts')

<script type="text/javascript" src="/plugins/daterangepicker/moment.js"></script>
<script type="text/javascript" src="/plugins/daterangepicker/moment.es.js"></script>
<script type="text/javascript" src="/plugins/daterangepicker/daterangepicker.js"></script>

<script type="text/javascript">
 $(function() {
            var dateElement = $('#reportrange');
            moment.locale('es');
            var start;
            var startInput = $('input[name="date_start"]');
            if (startInput.val())
                start = moment(startInput.val(), 'YYYY-MM-DD');
            else
                start = moment();
            var end;
            var endInput = $('input[name="date_end"]');
            if (endInput.val())
                end = moment(endInput.val(), 'YYYY-MM-DD');
            else
                end = moment();
            dateElement.find('span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            dateElement.daterangepicker(
                    {
                        format: 'YYYY-MM-DD',
                        startDate: moment(),
                        endDate: moment().format('YYYY-MM-DD'),
                        ranges: {
                            'Hoy': [moment(), moment()],
                            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
                            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                            'Este mes': [moment().startOf('month'), moment().endOf('month')],
                            'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        opens: 'right',
                        buttonClasses: ['btn'],
                        separator: ' hasta ',
                        locale: {
                            applyLabel: 'Aplicar',
                            cancelLabel: 'Cancelar',
                            fromLabel: 'Desde',
                            toLabel: 'Hasta',
                            customRangeLabel: 'Otro Rango',
                            daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                            firstDay: 1
                        }
                    }, function (start, end, label) {
                        dateElement.find('span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

                        $('input[name="date_start"]').val(start.format('YYYY-MM-DD'));
                        $('input[name="date_end"]').val(end.format('YYYY-MM-DD'));
                    }
            );
        });
</script>

@append