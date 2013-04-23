# Recaptcha FormField Module

## Introduction

Provides a hidden FormField which allows form to validate for non-bot submissions
by checking if the value in that field is correct.

## Maintainer Contact

 * Elvinas Liutkevičius
   <elvinas (at) unisolutions (dot) eu>

## Requirements

 * SilverStripe 3
 * Requires [SpamProtectionModule](http://silverstripe.org/spam-protection-module/)

## Installation

 * Copy the `uniprotect` directory into your main SilverStripe webroot
 * Run ?flush=1

## Usage

### As a Standalone Field

If you want to use UniProtect field by itself, you can simply just include it as a field in your form.

	$uniprotectField = new UniProtectField('MyUniProtect');

### Integration with Spamprotection module

This requires the [[:modules:spamprotection|spamprotection module]] to be installed, see its documentation for details. You can use this field to protect any built informs on your website, including user comments in the [[:modules:blog]] module.

Configuration example in `mysite/_config.php`

	SpamProtectorManager::set_spam_protector('UniProtectProtector');

Then once you have setup this config you will need to include the spam protector field as per the instructions on the [[modules:spamprotection|spamprotection module]] page.
