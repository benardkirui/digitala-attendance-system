<head>
    <meta charset="utf-8">

    <!-- Start Global Mandatory Style
=====================================================================-->
    <link href="../assets/dist/css/base.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- dataTables css -->
    <link href="../assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style -->
    <link href="../assets/dist/css/component_ui.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style rtl -->
    <link href="../assets/dist/css/component_ui_rtl.css" rel="stylesheet" type="text/css">
    <!-- Custom css -->
    <link href="../assets/dist/css/custom.css" rel="stylesheet" type="text/css">
    <link href="../assets/plugins/modals/modal-component.css" rel="stylesheet" type="text/css">
    <!-- End Theme Layout Style
    =====================================================================-->
    <title></title>

    <script src="../assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(
            function() {
                $("#attachees").click(
                    function()
                    {
                        window.location.assign('assigned.php');

                    }
                );
                $("#admin").click(
                    function()
                    {
                        window.location.assign('daily_reports.php');
                    }
                );
                $("#supervisor").click(
                    function()
                    {
                        window.location.assign('weekly_report.php');
                    }
                );
                $("#reports").click(
                    function()
                    {
                        window.location.assign('profile.php');
                    }
                );



            });
    </script>
</head>