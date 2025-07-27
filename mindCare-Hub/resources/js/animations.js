document.addEventListener('alpine:init', () => {
    Alpine.data('fadeIn', () => ({
        init() {
            this.$el.classList.add('opacity-0', 'transition', 'duration-1000');
            setTimeout(() => {
                this.$el.classList.remove('opacity-0');
            }, 100);
        }
    }));
});
