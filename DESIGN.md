---
name: Moderasi & Toleransi
colors:
  surface: '#fbf9f8'
  surface-dim: '#dcd9d9'
  surface-bright: '#fbf9f8'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f6f3f2'
  surface-container: '#f0eded'
  surface-container-high: '#eae8e7'
  surface-container-highest: '#e4e2e1'
  on-surface: '#1b1c1c'
  on-surface-variant: '#424843'
  inverse-surface: '#303030'
  inverse-on-surface: '#f3f0f0'
  outline: '#727973'
  outline-variant: '#c2c8c2'
  surface-tint: '#4b6454'
  primary: '#425a4b'
  on-primary: '#ffffff'
  primary-container: '#5a7363'
  on-primary-container: '#dbf7e3'
  inverse-primary: '#b2cdba'
  secondary: '#964824'
  on-secondary: '#ffffff'
  secondary-container: '#fd9a6f'
  on-secondary-container: '#76300d'
  tertiary: '#56554d'
  on-tertiary: '#ffffff'
  tertiary-container: '#6f6d65'
  on-tertiary-container: '#f4f0e6'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#cee9d6'
  primary-fixed-dim: '#b2cdba'
  on-primary-fixed: '#082014'
  on-primary-fixed-variant: '#344c3e'
  secondary-fixed: '#ffdbcd'
  secondary-fixed-dim: '#ffb597'
  on-secondary-fixed: '#360f00'
  on-secondary-fixed-variant: '#77320e'
  tertiary-fixed: '#e6e2d8'
  tertiary-fixed-dim: '#cac6bd'
  on-tertiary-fixed: '#1c1c16'
  on-tertiary-fixed-variant: '#484740'
  background: '#fbf9f8'
  on-background: '#1b1c1c'
  surface-variant: '#e4e2e1'
typography:
  display-lg:
    fontFamily: Inter
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Inter
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
  headline-lg-mobile:
    fontFamily: Inter
    fontSize: 28px
    fontWeight: '600'
    lineHeight: 36px
  headline-md:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-md:
    fontFamily: Atkinson Hyperlegible Next
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
    letterSpacing: 0.01em
  label-sm:
    fontFamily: Atkinson Hyperlegible Next
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 16px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  unit: 8px
  container-max-width: 1200px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 40px
---

## Brand & Style
The brand personality of this design system is centered on the concept of *"Harmoni Nusantara"* (Archipelagic Harmony). It is designed to be a safe, digital sanctuary that fosters dialogue and understanding. The visual language avoids aggressive marketing tactics, opting instead for a **Minimalist-Modern** aesthetic that emphasizes breathing room (whitespace) and organic warmth.

The target audience encompasses a diverse demographic across Indonesia—from students to religious leaders. Consequently, the UI must evoke a sense of **serenity, neutrality, and institutional trust**. This is achieved through the use of soft earth-inspired colors and a clear, functional layout that prioritizes content over decorative flourishes.

## Colors
This design system utilizes a palette inspired by the Indonesian landscape:
*   **Primary (Sage Green):** Represents growth, peace, and moderation. Used for primary actions and key navigation elements.
*   **Secondary (Terracotta):** Represents the earth and cultural heritage. Used sparingly for highlights, call-to-actions, and active states to provide warmth.
*   **Tertiary (Cream/Ecru):** The primary background color. Unlike pure white, this soft cream reduces eye strain and creates a welcoming, paper-like feel.
*   **Neutral (Deep Charcoal):** Used for typography and iconography to ensure high contrast (WCAG AA compliance) against the cream background.

Color usage should prioritize a 60-30-10 distribution to maintain a "calming" ratio, with the tertiary cream dominating the screen real estate.

## Typography
The typography strategy focuses on **legibility and accessibility**. 
*   **Inter** is the primary typeface for its neutral, highly readable letterforms, ensuring that complex theological or social topics are easy to digest.
*   **Atkinson Hyperlegible Next** is introduced for labels and small UI elements (captions, tags) to maximize clarity for users with visual impairments.

Hierarchies are strictly enforced to prevent cognitive overload. We avoid all-caps for body text to maintain a friendly, conversational tone. Line heights are slightly generous (1.5x for body text) to aid reading for long-form articles.

## Layout & Spacing
This design system follows a **12-column fixed grid** for desktop and a **4-column fluid grid** for mobile. The spacing rhythm is based on a **base-8 unit** (8px), creating a predictable and balanced visual flow.

*   **Generous Padding:** Elements are given ample "breathable" space to reduce visual noise.
*   **Content Centering:** Main content is centered with wide margins on large screens to keep the focal point narrow and manageable.
*   **Sectioning:** Use vertical spacing of 64px–80px between major content sections to clearly delineate different topics without the need for harsh horizontal rules.

## Elevation & Depth
To maintain a "menenangkan" (calming) feel, this design system avoids heavy shadows or high-intensity lighting. 
*   **Tonal Layering:** Depth is primarily communicated through subtle shifts in color (e.g., a card slightly lighter or darker than the background).
*   **Low-Contrast Outlines:** Instead of shadows, use 1px borders in a slightly darker shade of the background (e.g., a Sage-tinted border for Green elements) to define boundaries.
*   **Soft Surface Elevation:** Only the primary Action Buttons and the "Text-to-Speech" FAB may use a very soft, diffused shadow (15% opacity of the Primary color) to suggest interactability.

## Shapes
The shape language is defined by **organic softness**. 
*   **Standard Radius:** 8px (0.5rem) for inputs and small cards.
*   **Large Radius:** 16px (1rem) for content containers and modular sections.
*   **Fully Rounded:** Used for tags, chips, and the TTS floating button to emphasize their distinct, tactile nature.

Harsh 90-degree angles are avoided to remove any "institutional coldness," replacing it with a "ramah" (friendly) Indonesian hospitality.

## Components

### Buttons & Inputs
*   **Primary Button:** Sage Green background with white or cream text. 8px rounded corners.
*   **Secondary Button:** Ghost style with a 1px Terracotta border and Terracotta text.
*   **Inputs:** Cream background with a subtle Sage-Grey border. Focus states use a 2px Sage Green ring for high visibility.

### Cards & Lists
*   **Article Cards:** Soft Cream background with 16px rounded corners. Use simple iconography (line-art style) to represent religious categories.
*   **Lists:** Dividers should be 1px thick in a very light Sage-Grey tone.

### Accessibility Feature: Text-to-Speech (TTS)
*   **Floating Button:** A persistent, circular floating action button (FAB) located in the bottom-right or bottom-left corner.
*   **Visuals:** High-contrast Terracotta background with a white "Speaker/Volume" icon.
*   **Interaction:** On tap, expands into a small horizontal controller (Play, Pause, Progress Bar) with rounded-pill ends.

### Chips & Tags
*   **Category Tags:** Soft Sage or Terracotta tints with low saturation. Used to label topics like "Toleransi," "Budaya," or "Pendidikan."