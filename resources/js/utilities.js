export class Awn {
    static success(vm, title, message) {
        const options = vm.$awn.options
        options.labels.success = title
        vm.$awn.success(message);
    }

    static warning(vm, title, message) {
        const options = vm.$awn.options
        options.labels.warning = title
        vm.$awn.warning(message);
    }

    static error(vm, title, message) {
        const options = vm.$awn.options
        options.labels.alert = title
        vm.$awn.alert(message);
    }

    static confirm(vm) {
        const options = vm.$awn.options;
        options.modal.okLabel = vm.$t('common.yes')
        options.modal.cancelLabel = vm.$t('common.no')
        options.labels.confirm = vm.$t('common.confirmation_required')
        vm.$awn.confirm(vm.$t('common.are_you_sure'), function () {
            return true
        }, function () {
            return false
        });
    }
}