<script>
    window.onload = function() {
        $staff = sessionStorage.getItem('_ud');

        if($staff == undefined || $staff == null) {
            window.location = 'http::'
        }   
        $parsedObj = JSON.parse($staff);

    }
</script>