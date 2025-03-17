<?php

class Contact {
    private array $formData = [];
    private array $errors = [];

    public function handleSubmission(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->formData = $_POST;
            $this->validate();
            if (empty($this->errors)) {
                // Process the form submission
                // Send email, save to database, etc.
            }
        }
    }

    private function validate(): void {
        if (empty($this->formData['name'])) {
            $this->errors['name'] = 'Le nom est requis';
        }
        if (empty($this->formData['email']) || !filter_var($this->formData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email invalide';
        }
        if (empty($this->formData['message'])) {
            $this->errors['message'] = 'Le message est requis';
        }
    }

    public function render(): string {
        ob_start();
        ?>
        <form method="POST" class="contact-form">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($this->formData['name'] ?? '') ?>">
                <?php if (isset($this->errors['name'])): ?>
                    <span class="error"><?= htmlspecialchars($this->errors['name']) ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($this->formData['email'] ?? '') ?>">
                <?php if (isset($this->errors['email'])): ?>
                    <span class="error"><?= htmlspecialchars($this->errors['email']) ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message"><?= htmlspecialchars($this->formData['message'] ?? '') ?></textarea>
                <?php if (isset($this->errors['message'])): ?>
                    <span class="error"><?= htmlspecialchars($this->errors['message']) ?></span>
                <?php endif; ?>
            </div>
            <button type="submit">Envoyer</button>
        </form>
        <?php
        return ob_get_clean();
    }
}
