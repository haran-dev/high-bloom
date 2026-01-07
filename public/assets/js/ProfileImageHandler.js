export default class ProfileImageHandler {
    constructor(container) {
        this.container = $(container);
        this.preview = this.container.find('.profile-preview');
        this.input = this.container.find('.profile-input');
        this.uploadBtn = this.container.find('.profile-upload-btn');
        this.removeBtn = this.container.find('.profile-remove-btn');
        this.defaultSrc = this.preview.attr('src');

        this.init();
    }

    init() {
        this.uploadBtn.on('click', () => this.input.trigger('click'));
        this.input.on('change', (e) => this.showPreview(e));
        this.removeBtn.on('click', () => this.removePreview());
    }

    showPreview(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            this.preview.attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }

    removePreview() {
        this.input.val('');
        this.preview.attr('src', this.defaultSrc);
    }

    static initAll(selector = '.row.mb-3') {
        $(selector).each(function () {
            new ProfileImageHandler(this);
        });
    }
}
