<?php

namespace Application\Sonata\MediaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationSonataMediaBundle extends Bundle {

    public function getParent() {
        return 'SonataMediaBundle';
    }

}
