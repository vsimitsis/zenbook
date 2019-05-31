<?php

namespace App\contracts;

interface SectionParent
{
    public function getModelName();

    public function getModelUrlName();
}