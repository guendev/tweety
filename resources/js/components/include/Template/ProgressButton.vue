<template>
    <div class="progress-button">
        <button type="submit" :form="form"><span>Submit</span></button>
        <svg class="progress-circle" width="70" height="70">
            <path d="m35,2.5c17.955803,0 32.5,14.544199 32.5,32.5c0,17.955803 -14.544197,32.5 -32.5,32.5c-17.955803,0 -32.5,-14.544197 -32.5,-32.5c0,-17.955801 14.544197,-32.5 32.5,-32.5z" style="stroke-dasharray: 204.244; stroke-dashoffset: 204.244;"></path>
        </svg>
        <svg class="checkmark" width="70" height="70">
            <path d="m31.5,46.5l15.3,-23.2" style="stroke-dasharray: 27.7908; stroke-dashoffset: 27.7908;"></path><path d="m31.5,46.5l-8.5,-7.1" style="stroke-dasharray: 11.0752; stroke-dashoffset: 11.0752;"></path>
        </svg>
        <svg class="cross" width="70" height="70">
            <path d="m35,35l-9.3,-9.3" style="stroke-dasharray: 13.1522; stroke-dashoffset: 13.1522;"></path>
            <path d="m35,35l9.3,9.3" style="stroke-dasharray: 13.1522; stroke-dashoffset: 13.1522;"></path>
            <path d="m35,35l-9.3,9.3" style="stroke-dasharray: 13.1522; stroke-dashoffset: 13.1522;"></path>
            <path d="m35,35l9.3,-9.3" style="stroke-dasharray: 13.1522; stroke-dashoffset: 13.1522;"></path>
        </svg>
    </div>
</template>

<script>
    export default {
        name: "ProgressButton"
    }
</script>

<style scoped>

</style>
