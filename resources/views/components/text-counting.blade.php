<span class="txt"> {{ $slot }}</span>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    $(document).ready(function() {
        $(".txt").each(function(index, element) {
            var txtElement = $(element).text();
            var endValue = parseInt(txtElement, 10); // Parse as an integer
            let startValue = 0;
            var duration = 10000;
            var step = (endValue - startValue) / (duration / 10); // Calculate step

            function updateCount(timestamp) {
                if (startValue < endValue) {
                    startValue += step * (timestamp - lastTimestamp);
                    if (startValue > endValue) {
                        startValue = endValue;
                    }
                    $(element).text(math.round(
                    startValue)); // Update the displayed value for this element
                    lastTimestamp = timestamp;
                    requestAnimationFrame(updateCount);
                }
            }

            var lastTimestamp = performance.now();
            requestAnimationFrame(updateCount);
        });
    });
</script>
