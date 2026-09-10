@extends('layouts.admin')

@section('title', $page->name.' CMS')
@section('hide_topbar', true)

@section('content')
  <div class="cms-toolbar">
    <div>
      <p class="eyebrow">{{ $page->name }} page CMS</p>
      <h1>{{ $page->name }}</h1>
      <p>Use the edit buttons on the page preview to update content and images.</p>
    </div>
    <a class="banner-button" href="{{ route($page->public_route) }}" target="_blank" rel="noopener">View public page</a>
  </div>

  @if (session('status'))
    <div class="admin-alert success">{{ session('status') }}</div>
  @endif

  @if ($errors->any())
    <div class="admin-alert error">{{ $errors->first() }}</div>
  @endif

  <div class="embedded-public-page">
    @if ($page->slug === 'home')
      <section class="hero cms-editable-block" style="--cms-hero-image: url('{{ $page->heroImageUrl() }}');">
        <button class="cms-inline-edit cms-hero-edit" type="button" data-open-modal="cmsBannerModal">✎ Edit banner</button>
        <div class="container">
          <div class="reveal visible">
            <img class="hero-logo" src="{{ asset('assets/images/logos/pts-hero-logo.png') }}" alt="Physical Therapy Services">
            <h1 class="sr-only">{{ $page->hero_title }}</h1>
            <p>{{ $page->hero_subtitle }}</p>
            <div class="hero-actions">
              <a class="btn btn-primary" href="{{ route('contact') }}">Contact Us</a>
              <a class="btn btn-light" href="tel:+15413457532">Call (541) 345-7532</a>
            </div>
            <div class="trust-list" aria-label="Clinic highlights">
              <span>Evidence-based treatment</span>
              <span>Manual therapy</span>
              <span>STOTT Pilates</span>
              <span>Graston Technique</span>
            </div>
          </div>
        </div>
      </section>
    @else
      <section class="page-hero cms-editable-block" style="--cms-hero-image: url('{{ $page->heroImageUrl() }}');">
        <button class="cms-inline-edit cms-hero-edit" type="button" data-open-modal="cmsBannerModal">✎ Edit banner</button>
        <div class="container reveal visible">
          <p class="eyebrow">{{ $page->hero_eyebrow }}</p>
          <h1>{{ $page->hero_title }}</h1>
          <p>{{ $page->hero_subtitle }}</p>
        </div>
      </section>
    @endif

    <div class="cms-body-preview" data-cms-body-preview>
      {!! html_entity_decode($page->body_html) !!}
    </div>
  </div>

  <div class="cms-modal" id="cmsBannerModal" hidden>
    <div class="cms-modal-backdrop" data-close-modal></div>
    <form class="cms-modal-panel cms-editor-form" action="{{ route('admin.cms.update', $page->slug) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="cms-modal-header">
        <div>
          <p class="eyebrow">Banner settings</p>
          <h2>Edit {{ $page->name }} banner</h2>
          <p>Update the banner text or replace the banner photo.</p>
        </div>
        <button class="cms-modal-close" type="button" data-close-modal aria-label="Close modal">×</button>
      </div>

      <textarea class="cms-hidden-field" name="body_html" data-body-html-field>{{ html_entity_decode($page->body_html) }}</textarea>

      <div class="editor-fields">
        @if ($page->slug === 'home')
          <input name="hero_eyebrow" type="hidden" value="{{ old('hero_eyebrow', $page->hero_eyebrow) }}">
        @else
          <label>Banner eyebrow
            <input name="hero_eyebrow" type="text" value="{{ old('hero_eyebrow', $page->hero_eyebrow) }}" required>
          </label>
        @endif

        <label>Banner title
          <input name="hero_title" type="text" value="{{ old('hero_title', $page->hero_title) }}" required>
        </label>

        <label>Banner subtitle
          <textarea name="hero_subtitle" rows="3" @if($page->slug !== 'home') required @endif>{{ old('hero_subtitle', $page->hero_subtitle) }}</textarea>
        </label>

        <label>Banner photo
          <input name="hero_image" type="file" accept="image/*">
          <span class="field-help">Upload a new image only if you want to replace the current banner photo.</span>
        </label>
      </div>

      <div class="cms-modal-actions">
        <button class="btn btn-primary" type="submit">Save banner</button>
        <button class="btn btn-ghost" type="button" data-close-modal>Cancel</button>
      </div>
    </form>
  </div>

  <div class="cms-modal" id="cmsSectionModal" hidden>
    <div class="cms-modal-backdrop" data-close-modal></div>
    <form class="cms-modal-panel cms-editor-form" action="{{ route('admin.cms.update', $page->slug) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <input name="hero_eyebrow" type="hidden" value="{{ $page->hero_eyebrow }}">
      <input name="hero_title" type="hidden" value="{{ $page->hero_title }}">
      <input name="hero_subtitle" type="hidden" value="{{ $page->hero_subtitle }}">
      <textarea class="cms-hidden-field" name="body_html" data-body-html-field>{{ html_entity_decode($page->body_html) }}</textarea>

      <div class="cms-modal-header">
        <div>
          <p class="eyebrow">Page content</p>
          <h2>Edit selected content</h2>
          <p>Each outlined part/card can be clicked and edited directly, then saved together.</p>
        </div>
        <button class="cms-modal-close" type="button" data-close-modal aria-label="Close modal">×</button>
      </div>

      <div class="section-image-controls" data-section-image-controls hidden></div>
      <div class="section-visual-editor" contenteditable="true" data-section-editor></div>

      <div class="cms-modal-actions">
        <button class="btn btn-primary" type="submit">Save content</button>
        <button class="btn btn-ghost" type="button" data-close-modal>Cancel</button>
      </div>
    </form>
  </div>
@endsection

@section('scripts')
  <script>
    const bodyPreview = document.querySelector('[data-cms-body-preview]');
    const sectionModal = document.getElementById('cmsSectionModal');
    const sectionEditor = document.querySelector('[data-section-editor]');
    const sectionImageControls = document.querySelector('[data-section-image-controls]');
    const cmsScrollKey = 'pts-cms-scroll-{{ $page->slug }}';
    let activeSection = null;

    const rememberScrollPosition = () => {
      sessionStorage.setItem(cmsScrollKey, String(window.scrollY));
    };

    const restoreScrollPosition = () => {
      const savedScroll = sessionStorage.getItem(cmsScrollKey);

      if (savedScroll === null) {
        return;
      }

      sessionStorage.removeItem(cmsScrollKey);
      window.requestAnimationFrame(() => {
        window.scrollTo({ top: Number(savedScroll), left: 0, behavior: 'auto' });
      });
    };

    restoreScrollPosition();

    const openModal = (modal) => {
      if (!modal) return;
      modal.hidden = false;
      document.body.classList.add('cms-modal-open');
    };

    const closeModal = (modal) => {
      if (!modal) return;
      modal.hidden = true;
      document.body.classList.remove('cms-modal-open');
    };

    const showCmsFeedback = (message, type = 'success') => {
      let feedback = document.querySelector('[data-cms-feedback]');

      if (!feedback) {
        feedback = document.createElement('div');
        feedback.setAttribute('data-cms-feedback', 'true');
        document.body.append(feedback);
      }

      feedback.className = `admin-alert cms-floating-feedback ${type}`;
      feedback.textContent = message;

      window.clearTimeout(showCmsFeedback.hideTimer);
      showCmsFeedback.hideTimer = window.setTimeout(() => {
        feedback.remove();
      }, 2600);
    };

    const cleanBodyHtml = () => {
      if (!bodyPreview) return '';

      const clone = bodyPreview.cloneNode(true);
      clone.querySelectorAll('.cms-section-tools, .cms-status-badge, .cms-hidden-badge').forEach((tool) => tool.remove());
      clone.querySelectorAll('.cms-editable-section').forEach((section) => {
        section.classList.remove('cms-editable-section', 'cms-section-hidden');
        section.removeAttribute('data-cms-tools-ready');
      });

      return clone.innerHTML.trim();
    };

    const fillBodyFields = () => {
      document.querySelectorAll('[data-body-html-field]').forEach((field) => {
        field.value = cleanBodyHtml();
      });
    };

    const resetImageControls = () => {
      if (!sectionImageControls) return;

      sectionImageControls.innerHTML = '';
      sectionImageControls.hidden = true;
    };

    const addSectionImageControls = (sectionClone) => {
      resetImageControls();

      if (!sectionImageControls) return;

      const imageTargets = sectionClone.querySelectorAll('.owned-visual, [data-cms-editable-image]');

      if (!imageTargets.length) {
        return;
      }

      sectionImageControls.hidden = false;
      sectionImageControls.innerHTML = '<h3>Replace background photos</h3><p>Choose a new photo for any card below. Any size will fill the card neatly.</p>';

      imageTargets.forEach((target, index) => {
        const token = `section-image-${index}`;
        const label = target.querySelector('span')?.textContent?.trim() || target.getAttribute('aria-label') || `Image ${index + 1}`;

        target.setAttribute('data-upload-token', token);
        target.setAttribute('data-cms-editable-image', 'true');

        const field = document.createElement('label');
        field.className = 'section-image-field';
        field.innerHTML = `<span>${label}</span><input type="file" name="section_images[${token}]" accept="image/*">`;
        sectionImageControls.append(field);
      });
    };

    document.querySelectorAll('[data-open-modal]').forEach((button) => {
      button.addEventListener('click', () => {
        openModal(document.getElementById(button.dataset.openModal));
      });
    });

    document.querySelectorAll('[data-close-modal]').forEach((button) => {
      button.addEventListener('click', () => closeModal(button.closest('.cms-modal')));
    });

    const updateSectionStatus = (section, isHidden) => {
      const toggleButton = section.querySelector('.cms-visibility-toggle');
      const statusBadge = section.querySelector('.cms-status-badge');

      if (isHidden) {
        section.dataset.cmsHidden = 'true';
        section.classList.add('cms-section-hidden');
        if (toggleButton) {
          toggleButton.textContent = '＋ Show section';
        }
        if (statusBadge) {
          statusBadge.textContent = 'Hidden on public site';
          statusBadge.classList.remove('visible');
          statusBadge.classList.add('hidden');
        }
      } else {
        delete section.dataset.cmsHidden;
        section.classList.remove('cms-section-hidden');
        if (toggleButton) {
          toggleButton.textContent = '− Hide section';
        }
        if (statusBadge) {
          statusBadge.textContent = 'Visible on public site';
          statusBadge.classList.remove('hidden');
          statusBadge.classList.add('visible');
        }
      }
    };

    const initializeCmsSections = () => {
      if (!bodyPreview) return;

      bodyPreview.querySelectorAll(':scope > .section').forEach((section) => {
        if (section.dataset.cmsToolsReady === 'true') {
          return;
        }

        section.dataset.cmsToolsReady = 'true';
        section.classList.add('cms-editable-section');
        const isHidden = section.dataset.cmsHidden === 'true';

        if (isHidden) {
          section.classList.add('cms-section-hidden');
        }

        const statusBadge = document.createElement('span');
        statusBadge.className = `cms-status-badge ${isHidden ? 'hidden' : 'visible'}`;
        statusBadge.textContent = isHidden ? 'Hidden on public site' : 'Visible on public site';
        section.prepend(statusBadge);

        const tools = document.createElement('div');
        tools.className = 'cms-section-tools';

        const editButton = document.createElement('button');
        editButton.className = 'cms-inline-edit';
        editButton.type = 'button';
        editButton.textContent = '✎ Edit section';
        editButton.addEventListener('click', () => {
          activeSection = section;

          const clone = section.cloneNode(true);
          clone.querySelectorAll('.cms-section-tools, .cms-status-badge, .cms-hidden-badge').forEach((tool) => tool.remove());
          clone.querySelectorAll('.reveal').forEach((item) => item.classList.add('visible'));
          clone.classList.remove('cms-editable-section', 'cms-section-hidden');
          addSectionImageControls(clone);
          sectionEditor.innerHTML = clone.outerHTML;
          openModal(sectionModal);
        });

        const visibilityForm = document.createElement('form');
        visibilityForm.className = 'cms-visibility-form cms-editor-form';
        visibilityForm.action = '{{ route('admin.cms.update', $page->slug) }}';
        visibilityForm.method = 'post';
        visibilityForm.enctype = 'multipart/form-data';
        visibilityForm.innerHTML = `
          @csrf
          @method('PUT')
          <input name="hero_eyebrow" type="hidden" value="{{ e($page->hero_eyebrow) }}">
          <input name="hero_title" type="hidden" value="{{ e($page->hero_title) }}">
          <input name="hero_subtitle" type="hidden" value="{{ e($page->hero_subtitle) }}">
          <textarea class="cms-hidden-field" name="body_html" data-body-html-field>{{ e(html_entity_decode($page->body_html)) }}</textarea>
          <button class="cms-inline-edit cms-visibility-toggle" type="submit">${isHidden ? '＋ Show section' : '− Hide section'}</button>
        `;

        visibilityForm.addEventListener('submit', () => {
          const willHide = section.dataset.cmsHidden !== 'true';
          updateSectionStatus(section, willHide);
          fillBodyFields();
        });

        tools.append(editButton, visibilityForm);
        section.prepend(tools);
      });
    };

    initializeCmsSections();

    const refreshBodyPreview = (bodyHtml) => {
      if (!bodyPreview || !bodyHtml) return;

      bodyPreview.innerHTML = bodyHtml;
      initializeCmsSections();
    };

    const syncBannerPreview = (form, data) => {
      const title = form.querySelector('[name="hero_title"]')?.value;
      const subtitle = form.querySelector('[name="hero_subtitle"]')?.value;
      const eyebrow = form.querySelector('[name="hero_eyebrow"]')?.value;
      const hero = document.querySelector('.embedded-public-page .hero, .embedded-public-page .page-hero');

      if (!hero) return;

      if (data?.hero_image_url) {
        hero.style.setProperty('--cms-hero-image', `url('${data.hero_image_url}')`);
      }

      if (hero.classList.contains('hero')) {
        const heroSubtitle = hero.querySelector('.reveal > p');
        const heroTitle = hero.querySelector('h1');

        if (heroTitle && title !== undefined) {
          heroTitle.textContent = title;
        }
        if (heroSubtitle && subtitle !== undefined) {
          heroSubtitle.textContent = subtitle;
        }
      } else {
        const heroEyebrow = hero.querySelector('.eyebrow');
        const heroTitle = hero.querySelector('h1');
        const heroSubtitle = hero.querySelector('h1 + p');

        if (heroEyebrow && eyebrow !== undefined) {
          heroEyebrow.textContent = eyebrow;
        }
        if (heroTitle && title !== undefined) {
          heroTitle.textContent = title;
        }
        if (heroSubtitle && subtitle !== undefined) {
          heroSubtitle.textContent = subtitle;
        }
      }
    };

    document.querySelectorAll('.cms-editor-form').forEach((form) => {
      form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const currentScroll = window.scrollY;
        const submitButton = form.querySelector('[type="submit"]');
        const isVisibilityToggle = form.classList.contains('cms-visibility-form');
        const isSectionEdit = Boolean(form.closest('#cmsSectionModal'));
        const hasFileUploads = Array.from(form.querySelectorAll('input[type="file"]')).some((input) => input.files.length > 0);

        if (submitButton) {
          submitButton.disabled = true;
          submitButton.setAttribute('aria-busy', 'true');
        }

        if (isSectionEdit && activeSection && sectionEditor) {
          const wrapper = document.createElement('div');
          wrapper.innerHTML = sectionEditor.innerHTML.trim();
          const replacement = wrapper.firstElementChild;

          if (replacement) {
            activeSection.replaceWith(replacement);
            activeSection = replacement;
          }
        }

        fillBodyFields();

        try {
          const response = await fetch(form.action, {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
            },
            body: new FormData(form),
          });

          const data = await response.json();

          if (!response.ok) {
            const firstError = data?.message || Object.values(data?.errors || {})?.flat()?.[0] || 'The update could not be saved.';
            throw new Error(firstError);
          }

          if (form.closest('#cmsBannerModal')) {
            syncBannerPreview(form, data);
          }

          if (isSectionEdit && hasFileUploads) {
            refreshBodyPreview(data.body_html);
          } else if (isSectionEdit) {
            initializeCmsSections();
          }

          closeModal(form.closest('.cms-modal'));
          if (!isVisibilityToggle) {
            window.scrollTo({ top: currentScroll, left: 0, behavior: 'auto' });
          }
          showCmsFeedback(data.message || 'Changes saved successfully.');
        } catch (error) {
          showCmsFeedback(error.message || 'The update could not be saved.', 'error');
          if (!isVisibilityToggle) {
            window.scrollTo({ top: currentScroll, left: 0, behavior: 'auto' });
          }
        } finally {
          if (submitButton) {
            submitButton.disabled = false;
            submitButton.removeAttribute('aria-busy');
          }
        }
      });
    });
  </script>
@endsection
