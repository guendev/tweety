import {error} from "vue-infinite-loading/src/utils";

class UploadUi {
    static uploadProcess(error, $el) {
        if (error) {
            $el.removeClass('_uploading').addClass('_failed');
        } else {
            $el.removeClass('_uploading').addClass('_success');
        }
        setTimeout(() => {
            $el.removeClass((index, className) => {
                return (className.match(/\b_.\S+/g) || []).join(' ');
                //slot for a methods or anything
            })
        }, 2000)
    }

    static addClassBeforeProcess($el) {
        let $this = $($el);
        $this.addClass('_prosessing _uploading');
        return $this;
    }
}
export default UploadUi;
