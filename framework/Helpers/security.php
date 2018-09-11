<?php

if (!function_exists('bcrypt')) {
    /**
     * Hash the given value using bcrypt.
     *
     * @param string $value
     * @param array $options
     * @return string
     *
     * @throws \RuntimeException
     */
    function bcrypt($value, array $options = [])
    {
        $hash = password_hash($value, PASSWORD_BCRYPT, [
            'cost' => $options['rounds'] ?? 10,
        ]);

        if ($hash === false) {
            throw new RuntimeException('Bcrypt hashing not supported.');
        }

        return $hash;
    }
}
