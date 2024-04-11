<script>
    @if (session('success'))
        Lobibox.notify('success', {
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            size: 'mini',
            icon: 'bx bx-check-circle',
            msg: '{{ session('success') }}'
        });
    @endif
    @if (session('error'))
        Lobibox.notify('error', {
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            size: 'mini',
            icon: 'bx bx-check-circle',
            msg: '{{ session('error') }}'
        });
    @endif
    @if (session('info'))
        Lobibox.notify('info', {
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            size: 'mini',
            icon: 'bx bx-check-circle',
            msg: '{{ session('info') }}'
        });
    @endif
    @if (session('warning'))
        Lobibox.notify('warning', {
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            size: 'mini',
            icon: 'bx bx-check-circle',
            msg: '{{ session('warning') }}'
        });
    @endif
</script>
