<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AssignedDietician
 *
 * @property int $id
 * @property int $dietician_assignment_id
 * @property int $dietician_id
 * @property string $role dietician,assistant,substitute
 * @property string $status pending,assigned,completed,cancelled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DieticianAssignment $assignment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chat[] $chats
 * @property-read int|null $chats_count
 * @property-read \App\Models\Dietician $dietician
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedDietician newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedDietician newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedDietician query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedDietician whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedDietician whereDieticianAssignmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedDietician whereDieticianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedDietician whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedDietician whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedDietician whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedDietician whereUpdatedAt($value)
 */
	class AssignedDietician extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BaseIngredient
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BaseIngredient active($status = 'active')
 * @method static \Illuminate\Database\Eloquent\Builder|BaseIngredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseIngredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseIngredient query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseIngredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseIngredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseIngredient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseIngredient whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseIngredient whereUpdatedAt($value)
 */
	class BaseIngredient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Blog
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int|null $dietician_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $is_featured
 * @property string $is_paid
 * @property-read \App\Models\Dietician|null $dietician
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $direct_tags
 * @property-read int|null $direct_tags_count
 * @property-read int|null $likes_count
 * @property-read \App\Models\BlogImage|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BlogImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Like[] $likes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BlogTag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDieticianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedAt($value)
 */
	class Blog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BlogImage
 *
 * @property int $id
 * @property int $blog_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BlogImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogImage whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogImage whereUpdatedAt($value)
 */
	class BlogImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BlogTag
 *
 * @property int $id
 * @property int $blog_id
 * @property int $tag_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tag $tag
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereUpdatedAt($value)
 */
	class BlogTag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Chat
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $assigned_dietician_id
 * @property int|null $dietician_assignment_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DieticianAssignment|null $assignment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read int|null $messages_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereAssignedDieticianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereDieticianAssignmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUserId($value)
 */
	class Chat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Coupon
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property string $discount_type
 * @property int $discount_value
 * @property string $currency
 * @property int|null $max_discount_amount
 * @property string $status
 * @property string|null $expiry_date
 * @property string|null $start_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon active($status = 'active')
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMaxDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 */
	class Coupon extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Dietician
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $username
 * @property string|null $image
 * @property string $phone
 * @property string $gender
 * @property string $address
 * @property string|null $location
 * @property string|null $device_id
 * @property string $password
 * @property string|null $remember_token
 * @property string $status
 * @property string $for
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserDailyDiet[] $assigned_daily_diets
 * @property-read int|null $assigned_daily_diets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AssignedDietician[] $assignments
 * @property-read int|null $assignments_count
 * @property-read \App\Models\DieticianBankDetails|null $bank
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chat[] $chats
 * @property-read int|null $chats_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Expertise[] $direct_expertise
 * @property-read int|null $direct_expertise_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DieticianExpertise[] $expertise
 * @property-read int|null $expertise_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician active($status = 'active')
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician newQuery()
 * @method static \Illuminate\Database\Query\Builder|Dietician onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dietician whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|Dietician withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Dietician withoutTrashed()
 */
	class Dietician extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DieticianAssignment
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $status pending,assigned,completed,cancelled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $expiry
 * @property mixed|null $form_data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AssignedDietician[] $assigned_dieticians
 * @property-read int|null $assigned_dieticians_count
 * @property-read \App\Models\Chat|null $chat
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianAssignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianAssignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianAssignment query()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianAssignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianAssignment whereExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianAssignment whereFormData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianAssignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianAssignment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianAssignment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianAssignment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianAssignment whereUuid($value)
 */
	class DieticianAssignment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DieticianBankDetails
 *
 * @property int $id
 * @property int $dietician_id
 * @property string $bank_name
 * @property string $account_number
 * @property string $ifsc_code
 * @property string $branch_name
 * @property string $status
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails active($status = 'active')
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails whereBranchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails whereDieticianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails whereIfscCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianBankDetails whereUpdatedAt($value)
 */
	class DieticianBankDetails extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DieticianExpertise
 *
 * @property int $id
 * @property int $dietician_id
 * @property int $expertise_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianExpertise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianExpertise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianExpertise query()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianExpertise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianExpertise whereDieticianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianExpertise whereExpertiseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianExpertise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianExpertise whereUpdatedAt($value)
 */
	class DieticianExpertise extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DieticianKyc
 *
 * @property int $id
 * @property int $dietician_id
 * @property string|null $aadhar_card_number
 * @property string|null $aadhar_card_image
 * @property string|null $pan_card_number
 * @property string|null $pan_card_image
 * @property string $certificate
 * @property string $status
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc active($status = 'active')
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc query()
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc whereAadharCardImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc whereAadharCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc whereCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc whereDieticianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc wherePanCardImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc wherePanCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DieticianKyc whereUpdatedAt($value)
 */
	class DieticianKyc extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Expertise
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $icon
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dietician|null $dieticians
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise active()
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise query()
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expertise whereUpdatedAt($value)
 */
	class Expertise extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Faq
 *
 * @property int $id
 * @property int $faq_category_id
 * @property string $question
 * @property string $answer
 * @property string $status
 * @property string $is_featured
 * @property string $is_paid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\FaqCategory $faq_category
 * @method static \Illuminate\Database\Eloquent\Builder|Faq active()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq isFeatured()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq isPaid()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereFaqCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereUpdatedAt($value)
 */
	class Faq extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FaqCategory
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Faq[] $faqs
 * @property-read int|null $faqs_count
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory active()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereUpdatedAt($value)
 */
	class FaqCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Food
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FoodIngredient[] $food_ingredients
 * @property-read int|null $food_ingredients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FoodImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 * @property-read int|null $ingredients_count
 * @method static \Illuminate\Database\Eloquent\Builder|Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food query()
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereUpdatedAt($value)
 */
	class Food extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FoodImage
 *
 * @property int $id
 * @property int $food_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Food $food
 * @method static \Illuminate\Database\Eloquent\Builder|FoodImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FoodImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FoodImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|FoodImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoodImage whereFoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoodImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoodImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoodImage whereUpdatedAt($value)
 */
	class FoodImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FoodIngredient
 *
 * @property int $id
 * @property int $food_id
 * @property int $ingredient_id
 * @property float $quantity
 * @property string $unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Food $food
 * @property-read \App\Models\Ingredient $ingredient
 * @method static \Illuminate\Database\Eloquent\Builder|FoodIngredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FoodIngredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FoodIngredient query()
 * @method static \Illuminate\Database\Eloquent\Builder|FoodIngredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoodIngredient whereFoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoodIngredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoodIngredient whereIngredientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoodIngredient whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoodIngredient whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoodIngredient whereUpdatedAt($value)
 */
	class FoodIngredient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ingredient
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $image
 * @property string|null $caution
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient active($status = 'active')
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereCaution($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereUpdatedAt($value)
 */
	class Ingredient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Like
 *
 * @property int $id
 * @property string $likeable_type
 * @property int $likeable_id
 * @property string $liker_type
 * @property int $liker_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $likeable
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $liker
 * @method static \Illuminate\Database\Eloquent\Builder|Like newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Like newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Like query()
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereLikeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereLikeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereLikerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereLikerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereUpdatedAt($value)
 */
	class Like extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MedicalCondition
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalCondition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalCondition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalCondition query()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalCondition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalCondition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalCondition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalCondition whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalCondition whereUpdatedAt($value)
 */
	class MedicalCondition extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property int $id
 * @property int $chat_id
 * @property int|null $user_id
 * @property int|null $dietician_id
 * @property string|null $message
 * @property string|null $read_at
 * @property int|null $reply_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dietician|null $dietician
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MessageMedia[] $media
 * @property-read int|null $media_count
 * @property-read Message|null $reply
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereDieticianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereReplyTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MessageMedia
 *
 * @property int $id
 * @property int $message_id
 * @property string $media_type
 * @property mixed $media_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMedia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMedia whereMediaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMedia whereMediaType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMedia whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMedia whereUpdatedAt($value)
 */
	class MessageMedia extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mood
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Mood active($status = 'active')
 * @method static \Illuminate\Database\Eloquent\Builder|Mood newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mood newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mood query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mood whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mood whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mood whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mood whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mood whereUpdatedAt($value)
 */
	class Mood extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MoodQuote
 *
 * @property int $id
 * @property int $mood_id
 * @property string $quotes
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Mood $mood
 * @method static \Illuminate\Database\Eloquent\Builder|MoodQuote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MoodQuote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MoodQuote query()
 * @method static \Illuminate\Database\Eloquent\Builder|MoodQuote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoodQuote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoodQuote whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoodQuote whereMoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoodQuote whereQuotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoodQuote whereUpdatedAt($value)
 */
	class MoodQuote extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Nutrient
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Nutrient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nutrient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nutrient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Nutrient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nutrient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nutrient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nutrient whereUpdatedAt($value)
 */
	class Nutrient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Otp
 *
 * @property int $id
 * @property string $phone
 * @property string $otp
 * @property string $expire_at
 * @property string $used
 * @property int $attempt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Otp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Otp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Otp query()
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereAttempt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereExpireAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereUsed($value)
 */
	class Otp extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Package
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $terms
 * @property int $duration
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PackageCoupon[] $coupons
 * @property-read int|null $coupons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PackageFeature[] $features
 * @property-read int|null $features_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PackagePrice[] $prices
 * @property-read int|null $prices_count
 * @method static \Illuminate\Database\Eloquent\Builder|Package active()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUpdatedAt($value)
 */
	class Package extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PackageCoupon
 *
 * @property int $id
 * @property int $package_id
 * @property int $coupon_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coupon $coupon
 * @property-read \App\Models\Package $package
 * @method static \Illuminate\Database\Eloquent\Builder|PackageCoupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackageCoupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackageCoupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|PackageCoupon whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageCoupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageCoupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageCoupon wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageCoupon whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageCoupon whereUpdatedAt($value)
 */
	class PackageCoupon extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PackageFeature
 *
 * @property int $id
 * @property int $package_id
 * @property string $title
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Package $package
 * @method static \Illuminate\Database\Eloquent\Builder|PackageFeature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackageFeature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackageFeature query()
 * @method static \Illuminate\Database\Eloquent\Builder|PackageFeature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageFeature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageFeature wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageFeature whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageFeature whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageFeature whereUpdatedAt($value)
 */
	class PackageFeature extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PackagePrice
 *
 * @property int $id
 * @property int $package_id
 * @property string $currency
 * @property string $price
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Package $package
 * @method static \Illuminate\Database\Eloquent\Builder|PackagePrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackagePrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackagePrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|PackagePrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagePrice whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagePrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagePrice wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagePrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagePrice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagePrice whereUpdatedAt($value)
 */
	class PackagePrice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentOrder
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentOrder whereUpdatedAt($value)
 */
	class PaymentOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductMedia[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product active($status = 'active')
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUrl($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductMedia
 *
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia whereUpdatedAt($value)
 */
	class ProductMedia extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RazorpayOrder
 *
 * @property int $id
 * @property string $order_id
 * @property mixed $package
 * @property int $user_id
 * @property string $type new,renew
 * @property float $amount
 * @property string $currency
 * @property float|null $discount
 * @property string|null $coupon_code
 * @property float|null $tax
 * @property float $payable_amount
 * @property string $status pending,paid,failed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed|null $form_data
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereCouponCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereFormData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder wherePackage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder wherePayableAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayOrder whereUserId($value)
 */
	class RazorpayOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RazorpayTransaction
 *
 * @property int $id
 * @property string $transaction_id
 * @property int|null $user_subscription_id
 * @property int $order_id
 * @property float $paid_amount
 * @property string $currency
 * @property int $refunded
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction whereRefunded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RazorpayTransaction whereUserSubscriptionId($value)
 */
	class RazorpayTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Recipe
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $caution
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $is_paid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Nutrient[] $compositions
 * @property-read int|null $compositions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Food[] $foods
 * @property-read int|null $foods_count
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Like[] $likes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe active()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereCaution($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereUpdatedAt($value)
 */
	class Recipe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RecipeComposition
 *
 * @property int $id
 * @property int $recipe_id
 * @property int $nutrient_id
 * @property float $percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Nutrient $nutrient
 * @property-read \App\Models\Recipe $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeComposition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeComposition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeComposition query()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeComposition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeComposition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeComposition whereNutrientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeComposition wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeComposition whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeComposition whereUpdatedAt($value)
 */
	class RecipeComposition extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RecipeFood
 *
 * @property int $id
 * @property int $recipe_id
 * @property int $food_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Food $food
 * @property-read \App\Models\Recipe $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeFood newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeFood newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeFood query()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeFood whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeFood whereFoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeFood whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeFood whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeFood whereUpdatedAt($value)
 */
	class RecipeFood extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RecipeTags
 *
 * @property int $id
 * @property int $recipe_id
 * @property int $tag_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeTags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeTags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeTags query()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeTags whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeTags whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeTags whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeTags whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeTags whereUpdatedAt($value)
 */
	class RecipeTags extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tag active($active = 'active')
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Template
 *
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property int $days
 * @property string $type
 * @property string|null $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recipe[] $recipes
 * @property-read int|null $recipes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TemplateRecipe[] $template_recipes
 * @property-read int|null $template_recipes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Template active()
 * @method static \Illuminate\Database\Eloquent\Builder|Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUpdatedAt($value)
 */
	class Template extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TemplateRecipe
 *
 * @property int $id
 * @property int $template_id
 * @property int $recipe_id
 * @property string $for breakfast, lunch, dinner, snack, dessert, etc.
 * @property int $day
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Recipe $recipe
 * @property-read \App\Models\Template $template
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateRecipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateRecipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateRecipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateRecipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateRecipe whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateRecipe whereFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateRecipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateRecipe whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateRecipe whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateRecipe whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateRecipe whereUpdatedAt($value)
 */
	class TemplateRecipe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Testimonial
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string|null $subtitle
 * @property string $testimonial
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial active()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereTestimonial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereUpdatedAt($value)
 */
	class Testimonial extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $image
 * @property string $phone
 * @property string|null $device_id
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string $isAdmin
 * @property string|null $deleted_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $firebase_uid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DieticianAssignment[] $assignments
 * @property-read int|null $assignments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chat[] $chats
 * @property-read int|null $chats_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserDailyDiet[] $daily_diet
 * @property-read int|null $daily_diet_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserMedicalCondition[] $medical_conditions
 * @property-read int|null $medical_conditions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserMoodTracker[] $moods
 * @property-read int|null $moods_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserStepCounter[] $steps
 * @property-read int|null $steps_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserSubscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\UserData|null $user_data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserWaterTracker[] $water
 * @property-read int|null $water_count
 * @method static \Illuminate\Database\Eloquent\Builder|User isCurrentlySubscribed()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User notAdmin()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirebaseUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * App\Models\UserActivity
 *
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivity query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivity whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivity whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivity whereUpdatedAt($value)
 */
	class UserActivity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserDailyDiet
 *
 * @property int $id
 * @property int $user_id
 * @property int $dietician_id
 * @property mixed $diet
 * @property string $schedule_date
 * @property int $is_completed
 * @property string|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dietician $dietician
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet completed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet forUpcomingDays(int $days, ?string $date = null)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet uncompleted()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet whereDiet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet whereDieticianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet whereIsCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet whereScheduleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDailyDiet whereUserId($value)
 */
	class UserDailyDiet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserData
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $dob
 * @property string $gender
 * @property float $height
 * @property float $weight
 * @property float|null $target_weight
 * @property int|null $user_activity_id
 * @property int|null $user_goal_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\UserActivity|null $user_activity
 * @property-read \App\Models\UserGoal|null $user_goal
 * @method static \Illuminate\Database\Eloquent\Builder|UserData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserData query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserData whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserData whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserData whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserData whereTargetWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserData whereUserActivityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserData whereUserGoalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserData whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserData whereWeight($value)
 */
	class UserData extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserGoal
 *
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoal query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoal whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoal whereUpdatedAt($value)
 */
	class UserGoal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserMedicalCondition
 *
 * @property int $id
 * @property int $user_id
 * @property int $medical_condition_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MedicalCondition $condition
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserMedicalCondition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMedicalCondition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMedicalCondition query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMedicalCondition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMedicalCondition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMedicalCondition whereMedicalConditionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMedicalCondition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMedicalCondition whereUserId($value)
 */
	class UserMedicalCondition extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserMoodTracker
 *
 * @property int $id
 * @property int $user_id
 * @property int $mood_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Mood $mood
 * @method static \Illuminate\Database\Eloquent\Builder|UserMoodTracker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMoodTracker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMoodTracker query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMoodTracker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMoodTracker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMoodTracker whereMoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMoodTracker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMoodTracker whereUserId($value)
 */
	class UserMoodTracker extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserSleepSchedule
 *
 * @property int $id
 * @property int $user_id
 * @property string $sleep_time
 * @property string $wake_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserSleepSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSleepSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSleepSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSleepSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSleepSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSleepSchedule whereSleepTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSleepSchedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSleepSchedule whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSleepSchedule whereWakeTime($value)
 */
	class UserSleepSchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserStepCounter
 *
 * @property int $id
 * @property int $user_id
 * @property int $step_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserStepCounter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStepCounter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStepCounter query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStepCounter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStepCounter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStepCounter whereStepCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStepCounter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStepCounter whereUserId($value)
 */
	class UserStepCounter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserSubscription
 *
 * @property int $id
 * @property int $user_id
 * @property mixed $subscription
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $dietician_assignment_id
 * @property-read \App\Models\RazorpayTransaction|null $transaction
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereDieticianAssignmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereSubscription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscription whereUserId($value)
 */
	class UserSubscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserWaterTracker
 *
 * @property int $id
 * @property int $user_id
 * @property int $water_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserWaterTracker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWaterTracker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWaterTracker query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWaterTracker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWaterTracker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWaterTracker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWaterTracker whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWaterTracker whereWaterAmount($value)
 */
	class UserWaterTracker extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VersionControl
 *
 * @property int $id
 * @property float $android_version
 * @property float $ios_version
 * @property int $android_force_update
 * @property int $ios_force_update
 * @property string|null $android_update_message
 * @property string|null $ios_update_message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl query()
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl whereAndroidForceUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl whereAndroidUpdateMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl whereAndroidVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl whereIosForceUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl whereIosUpdateMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl whereIosVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VersionControl whereUpdatedAt($value)
 */
	class VersionControl extends \Eloquent {}
}

