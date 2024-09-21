<?php

namespace Binafy\LaravelReaction\Enums;

enum LaravelReactionTypeEnum: string
{
    case REACTION_LIKE = 'like';
    case REACTION_LOVE = 'love';
    case REACTION_SAD = 'sad';
    case REACTION_CLAP = 'clap';
    case REACTION_FIRE = 'fire';
    case REACTION_UNLIKE = 'unlike';
    case REACTION_ANGRY = 'angry';
    case REACTION_WOW = 'wow';
}
