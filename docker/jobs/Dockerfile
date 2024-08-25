
FROM php:7.4-cli

# Set working directory
WORKDIR /var/www

# Install supervisor
RUN apt-get update && apt-get install -y supervisor

# Copy application files
COPY . /var/www

# Copy supervisor configuration
COPY docker/jobs/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set permissions
RUN chown -R www-data:www-data /var/www

# Expose port for listening to jobs
EXPOSE 9000

# Start supervisor
CMD ["/usr/bin/supervisord"]
