<?php

namespace {roots}Interfaces;

interface AchievementInterface
{
    public function handle( ...$args );

    public function progress(): int;

    public function target(): int;
}

