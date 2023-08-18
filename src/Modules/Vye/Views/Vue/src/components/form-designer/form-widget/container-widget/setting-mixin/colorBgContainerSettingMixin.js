export default {
    computed: {
        colorBgOrGradient() {
            let result;
            if (this.widget.options.activeGradientBg) {
                result =
                    this.widget.options.directionGradientBg + " " +
                    this.widget.options.fromColorBg + " " +
                    this.widget.options.viaColorBg + " " +
                    this.widget.options.toColorBg;
            } else {
                result = this.onlyColorBg;
            }
            return result;
        },
        onlyColorBg() {
            return this.widget.options.bgColor;
        },
        customBackgroundColor() {
            if (this.widget.options.activeCustomBackgroundColor) {
                return this.widget.options.backgroundColor;
            } else {
                return '';
            }
        },
    }
};
