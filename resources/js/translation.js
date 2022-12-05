export const translation = {
    __(key, replace = {}) {
        let myObject = key.split('.');
        var translation = this.$page.props.language || key;
        for (let i = 0; i < myObject.length; i++) {
            translation = translation[myObject[i]] ? translation[myObject[i]] : key;
        }
        Object.keys(replace).forEach(function (key) {
            translation = translation.replaceAll(':' + key, replace[key]);
        });

        return translation;
    },
    /** Pluralization */
    __n(key, number = 1, replace = {}) {
        const translation = this.__(key, replace);
        var options = translation.split('|');
        key = number === 1 ? options[0] : options[1];
        return key;
    }
};
